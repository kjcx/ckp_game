<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/21
 * Time: 下午3:10
 * 掉落库数据mongo直接读取比较慢 框架初始化的时候加载到redis中
 */

namespace App\Models\Store;

use App\Models\BagInfo\Bag;
use App\Models\Excel\Drop;
use App\Models\Model;
use App\Models\Trade\Shop;
use App\Traits\MongoTrait;
use EasySwoole\Config;
use EasySwoole\Core\Component\Di;

class DropStore extends Model
{
    use MongoTrait;

    private $uid;

    private $mongoTable = 'ckzc.dropShop';
    private $redisKey;
    private $dropShopData;
    private $shopIds = ['11','12','13','14','15','107','108'];
    private $discount;
    private $goods = []; //随机的商品信息 为了不重复使用的

    public function __construct(Int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
        $this->collection = $this->getMongoClient();
        $this->setDiscount(); //设置折扣信息
    }



    /**
     * 刷新所有掉落库
     * 自动刷新掉落库
     * @return mixed
     */
    public function refreshDropShop()
    {

        $dropShops = $this->collection->find(['Id' => ['$in' => $this->shopIds]])->toArray();
        $goods = [];
        foreach ($dropShops as $dropKey => $dropShop) {
            $shops = [];
            foreach ($dropShop['Goods'] as $d_k => $shop) {
                $discounte = in_array($dropShop['Id'],['107','108']) ? $this->getDiscount() : 1; //获取折扣
                $goodsId = $this->randGoods($shop['DropLib']);
                if ($goodsId == false) {
                    continue;
                }
                $shops[] = array_merge($goodsId,
                    ['DiscountedPrice' => $discounte,'ShopType' => $dropShop['ShopType'],'GridId' => $d_k,'DropKuId' => $shop['Id']]);
            }
            $goods[] = $shops;
        }
        return $goods;
    }

    /**
     * 通过商店Id 刷新掉落库
     * @param String $shopId
     * @param bool $auto 自动 or 手动
     * @return array
     */
    public function refreshDropShopByShopId(String $shopId,Bool $auto = false)
    {
        if ($auto == false) {
            $this->manualRefresh($shopId);
        }
        $dropShop = $this->collection->findOne(['Id' => $shopId]);
        $goods = [];
        foreach ($dropShop['Goods'] as $d_k => $shop) {
            $shops = [];
                $discounte = in_array($shopId,['107','108']) ? $this->getDiscount() : 1; //获取折扣
                $goodsId = $this->randGoods($shop['DropLib']);
                if ($goodsId == false) {
                    continue;
                }
                $shops[] = array_merge($goodsId,
                    ['DiscountedPrice' => $discounte,'ShopType' => $dropShop['ShopType'],'GridId' => $d_k,'DropKuId' => $shop['Id']]);
                $goods[] = $shops;

        }
        return $goods;
    }

    /**
     *刷新手动扣费
     *最好作为事件触发
     */
    private function manualRefresh(String $shopId)
    {
        $refreshInfo = unserialize($this->redis->get('resetDrop:' . $this->uid));
        $lastDay = strtotime(date('Y-m-d',strtotime('+1 day'))); //明天
        $ttl = $lastDay - time(); //过期时间
        if ($refreshInfo == false) {
            //key没命中  概率比较低
            $refreshInfo = $this->createRefreshData();
            $this->redis->set('resetDrop:' . $this->uid,serialize($this->createRefreshData()),$ttl);
        }
        $refreshNum = $refreshInfo[$shopId]['refreshNum'];
        $refreshPrice = isset($refreshInfo[$shopId]['refreshPrice'][$refreshNum]) ? $refreshInfo[$shopId]['refreshPrice'][$refreshNum] : end($refreshInfo[$shopId]['refreshPrice']);
        //扣费
        $bag = new Bag();
        $bag->delBag(2,$refreshPrice);
        //重新写入
        $refreshInfo[$shopId]['refreshNum'] = $refreshInfo[$shopId]['refreshNum'] + 1;
        $refreshInfo[$shopId]['refreshTime'] = time();
        $this->redis->set('resetDrop:' . $this->uid,serialize($refreshInfo),$ttl);
        return [$refreshNum,$refreshPrice];
    }

    /**
     * 生成刷新次数数据
     * @return array
     */
    private function createRefreshData()
    {
        $shops = $this->shopIds;

        $shopsRefresh = $this->mongo->ckzc->config_Shop->find(['Id' => ['$in' => $shops]])->toArray();
        $shopsRefresh = (array)$shopsRefresh;
        $resetData = [];
        foreach ($shopsRefresh as $k => $v) {
            $resetData[$v['Id']] = [
                'refreshNum' => 0, //刷新次数
                'refreshTime' => 0, //刷新时间
                'refreshPrice' => explode(',',$v['RefreshCost']) //刷新价格
            ];
        }

        return $resetData;
    }
    /**
     * 获取折扣信息
     */
    private function getDiscount()
    {
        return $this->discount[array_rand($this->discount)];
    }
    /**
     * 设置折扣信息
     */
    private function setDiscount()
    {
        $data = $this->mongo->ckzc->Drop->findOne(['Id' => '5001']);
        if (!empty($data)) {
            $discounts = explode(';',$data['DropLib']);
            foreach ($discounts as $k => $discount) {
                $discount = explode(',',$discount);
                for ($i = 0; $i < $discount['3']; $i++) {
                    $this->discount[] = $discount['0'] / 10;
                }
            }
        }
    }
    /**
     * 随机一个商品出来
     * @param $dropLib
     * @return mixed
     */
    private function randGoods($dropLib)
    {
        $randArr = [];
        $dropLibHandle = array_diff(array_column((array)$dropLib,'0'),$this->goods);
        $dropLibs = [];
        foreach ($dropLib as $k => $v) {
            if (in_array($v['0'],$dropLibHandle)) {
                $dropLibs[] = (array)$v;
            }
        }
        foreach ($dropLibs as $k => $v) {
            for ($i = 0; $i < $v['weight']; $i++) {
                $randArr[] = $v;
            }
        }
        if (empty($randArr)) {
            return false;
        }
        $key = array_rand($randArr);
        $this->goods[] = $randArr[$key]['0'];
        return [
            'Id' => $randArr[$key]['0'],
            'Count' => rand($randArr[$key]['min'],
                $randArr[$key]['max'])
        ];
    }

    /**
     * 缓存掉落库
     */
    public function cacheDropShop()
    {
        
    }


}