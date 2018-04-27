<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/23
 * Time: 下午6:01
 * 用于生成掉落库的商品信息
 * 处理类  需要迁移到excel导入程序中
 *
 */

namespace App\Models\Store;

use App\Models\Model;
use App\Traits\MongoTrait;
use function Couchbase\basicEncoderV1;
use EasySwoole\Config;

class ShopConfig extends Model
{
    use MongoTrait;

    private $uid;

    private $shopType = 'ShopCenterType';

    public function __construct(Int $uid)
    {
        parent::__construct();
        $this->uid = $uid;

        $dbConf = Config::getInstance()->getConf('MONGO');
        $this->mongo = new \MongoDB\Client("mongodb://{$dbConf['hostname']}/");
    }

    /**
     * 获取掉落库的商店信息
     */
    private function getStore()
    {

        $store = $this->mongo->ckzc->GameEnum->findOne(['type' => $this->shopType]);
        if (!empty($store)) {
            return (array)$store[$this->shopType];
        }
        return [];
    }

    /**
     * 获取掉落库的商店详细信息
     */
    public function getShop()
    {
        $store = $this->getStore();
        $ids = array_column($store,'value');
        $shops = $this->mongo->ckzc->config_Shop->find(['Id' => ['$in' => $ids]])->toArray();
        foreach ($shops as $k => $v) {
            $shops[$k]['Goods'] = explode(',',$v['Goods']);
        }
        return $shops;
    }


    private function getDropGoods()
    {
        $shops = $this->getShop();
        $shops = array_column($shops,'Goods');
        $arr = [];
        foreach ($shops as $k => $v) {
            $arr = array_merge($arr,array_unique($v));
        }
        $ids = array_unique($arr);

        $dropGoods = $this->mongo->ckzc->Drop->find(['Id' => ['$in' => $ids]])->toArray();
        foreach ($dropGoods as $k => $v) {
            $dropGoods[$k]['DropLib'] = array_map(function ($v) {
                return explode(',',$v);
            },explode(';',$v['DropLib']));
        }
        return $dropGoods;
    }

    /**
     * 迭代goods里面的数据
     */
    public function iterationGoods()
    {
        $dropGoods = $this->getDropGoods();
        $a = array_column($dropGoods,'DropLib');
        $a = array_map(function ($v) {
            return array_column($v,'0');
        },$a);
        $ids = [];
        foreach ($a as $k => $v) {
            foreach ($v as $kk => $vv) {
                array_push($ids,(int)$vv);
            }
        }
        $ids = array_unique($ids);
        return $ids;
    }

    /**获得items商品
     * @return array
     */
    private function items()
    {
        $ids = $this->iterationGoods();
        $filter = ['Id' => ['$in' => $ids]];
        $result = $this->mongo->ckzc->item->find($filter)->toArray();

        return $result;
    }

    public function handle()
    {
        $dropGoods = $this->getDropGoods();
        $items = $this->items();

        $arr = [];
        foreach ($dropGoods as $k => $v) {
//            $dropGoods[$k]['DropLib']['0'] = 1;
            foreach ($v['DropLib'] as $kk => $vv) {
//                $dropGoods[$k]['DropLib'][$kk]['0'] =

                $dropGoods[$k]['DropLib'][$kk]['min'] = $vv['1'];
                unset($dropGoods[$k]['DropLib'][$kk]['1']);
                $dropGoods[$k]['DropLib'][$kk]['max'] = $vv['2'];
                unset($dropGoods[$k]['DropLib'][$kk]['2']);
                $dropGoods[$k]['DropLib'][$kk]['weight'] = $vv['3'];
                unset($dropGoods[$k]['DropLib'][$kk]['3']);
            }

        }
        $_dropGoods = [];

        foreach ($dropGoods as $k => $v) {
            $_dropGoods[$v['Id']] = $v;
        }
        $shops = $this->getShop();
        foreach ($shops as $k => $v) {
            foreach ($v['Goods'] as $g_k => $g_v) {
                $shops[$k]['Goods'][$g_k] = $_dropGoods[$g_v];
            }
        }
        foreach ($shops as $k => $v) {
            $this->mongo->ckzc->dropShop->insertOne($v);
        }
        return $shops;
    }

}