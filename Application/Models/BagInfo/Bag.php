<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/10
 * Time: 下午1:19
 * 背包类
 */

namespace App\Models\BagInfo;

use App\Event\BagAddEvent;
use App\Event\BagDelEvent;
use App\Event\UserEvent;
use App\Models\Model;
use App\Models\User\Role;
use App\Models\Excel\Item;
use App\Utility\Cache;

class Bag extends Model
{
    private $uid;
    private $item; //item类为了验证信息   依赖
    private $initData; //初始化信息
    private $MaxCellNumber;
    private $GoldType = [1,2,6];//金币变化通知
    private $cache;
    private $bagListKey;//背包列表 key
    private $bagKeyPrefix; //背包详情 前缀 key

    public function __construct(int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
        //依赖进来 但是不需要注入
        $this->item = new Item();
        $this->initData = new Init();
        $this->MaxCellNumber = 999;
        $this->cache = Cache::getInstance();
        $this->init();
    }

    /**
     * 初始化类
     */
    public function init()
    {
        $this->bagListKey = 'bagList:uid:' . $this->uid;
        $this->bagKeyPrefix = 'bag:uid:' . $this->uid . ':item:';
    }
    /**
     * 加载背包 就用一回 把背包加载到redis中
     */
    public function loadBag()
    {
        $bagData = $this->getBag();
        $bagListKey = 'bagList:uid:' . $this->uid;
        if (!empty($bagData['data'])) {
            foreach ($bagData['data'] as $key => $data) {
                if (!empty($data)) {
                    $data = (array)$data;
                    $bagKey = 'bag:item:' . $data['id'] . ':uid:' . $this->uid;
                    $data['uid'] = $this->uid;
                    $this->cache->stringSet($bagKey,$data);
                    $this->cache->hashSet($bagListKey,$data['id'],$bagKey);
                }
            }
        }
        echo 'ok';

    }
    /**
     * 获取背包信息
     * @return array
     */
    public function getBag()
    {
        $bagList = $this->cache->client()->hGetAll($this->bagListKey);
        $data = [
            'uid' => $this->uid,
            'data' => []
        ];
        if (!empty($bagList)) {
            foreach ($bagList as $bag) {
                $bagData = $this->cache->stringGet($bag);
                if (isset($bagData['OnSpace'])) {
                    $data['data'][$bagData['id']] = $bagData;
                }
            }
        }
        if (!empty($data['data'])) {
            $data['MaxCellNumber'] = $this->MaxCellNumber;
            $data['CurUsedCell'] = array_sum(array_column((array)$data['data'],'OnSpace'));
            $data['Furnitrues'] = []; //家居 TODO::
            return (array)$data;
        }
        return [];
    }

    /**
     * 初始化背包信息
     */
    public function initBag()
    {

        if (!empty($this->getBag())) {
            return false;
        }

        $initData = $this->initData->getInitData();
        if (empty($initData)) {
            return false;
        }
        //生成背包数据
        //绑金 初始道具  初始创客币 初始金币
        $initData['goldBind']; //绑金
        $initData['item']; //初始道具
        $initData['coin']; //初始创客币
        $initData['gold']; //初始金币

        $goldBind = $this->createBagItem($initData['goldBind']['id'],$initData['goldBind']['count']);
        $this->cache->stringSet($goldBind['key'],$goldBind['data']);
        $this->cache->hashSet($this->bagListKey,$goldBind['data']['id'],$goldBind['key']);

        $item = $this->createBagItem($initData['item']['id'],$initData['item']['count']);
        $this->cache->stringSet($item['key'],$item['data']);
        $this->cache->hashSet($this->bagListKey,$item['data']['id'],$item['key']);

        $coin = $this->createBagItem($initData['coin']['id'],$initData['coin']['count']);
        $this->cache->stringSet($coin['key'],$coin['data']);
        $this->cache->hashSet($this->bagListKey,$coin['data']['id'],$coin['key']);

        $gold = $this->createBagItem($initData['gold']['id'],$initData['gold']['count']);
        $this->cache->stringSet($gold['key'],$gold['data']);
        $this->cache->hashSet($this->bagListKey,$gold['data']['id'],$gold['key']);

        return true;
    }

    /**
     * 创建背包详情的数据
     * @param $itemId
     * @param $num
     * @return array
     */
    private function createBagItem($itemId,$num)
    {
        $item = $this->item->getItemByid($itemId);
        $data = [
            'id' => $item['Id'],
            'uid' => $this->uid,
            'OnSpace' => $this->getOnSpace($item['Id'],$num),
            'CurCount' => $num
        ];
        return ['key' => $this->bagKeyPrefix . $item['Id'],'data' => $data];

    }

    /**
     *
     */
    private function updateBagItem()
    {

    }
    /**
     * 获取背包的单个商品
     * @param $itemId
     * @return array
     */
    public function getBagByItemId($itemId)
    {
        $data = $this->cache->stringGet($this->bagKeyPrefix . $itemId);
        return $data;
    }

    /**
     * @param $itemIds
     * @return array
     */
    public  function getBagByItemIds($itemIds)
    {
        $arr = [];
        foreach ($itemIds as $itemId) {
            $bagData = $this->getBagByItemId($itemId);
            if(isset($bagData['CurCount'])) {
                $arr[$itemId] = $bagData['CurCount'];
            } else {
                $arr[$itemId] = 0;
            }
        }
        return $arr;
    }

    /**
     * 验证背包是否有某个道具 并且数量满足
     * @param $id 道具id
     * @return bool
     */
    public function checkBagHasItemById($id)
    {
        $data = $this->getBagByItemId($id);
        if(!empty($data)){
            return $data;
        }else{
            return false;
        }
    }
    /**
     * 验证背包格子数量
     * @return array
     */
    private function checkBagSpace()
    {
        $bagData = (array)$this->getBag();
        $spaceArr = array_column($bagData,'OnSpace');
        //TODO::验证当前用户背包格子数量 暂时是999 以后改动读配置
        return array_sum($spaceArr) >= $this->MaxCellNumber ? false : true;
    }

    /**
     * 批量加商品
     * @param $items [['Id' => num]]
     */
    public function batchAddBag($items)
    {
        foreach ($items as $itemKey => $item) {
            $this->addBag($itemKey,$item,false);
        }
        $eventData = ['uid' => $this->uid,'evenFunc' => 'pushBag'];
        event(BagAddEvent::class,$eventData);
    }

    /**
     * 背包增加商品
     * @param $itemId 商品ID
     * @param Int $num 商品数量
     * @param $onPush 是否推送
     * @return bool|string
     */
    public function addBag($itemId,Int $num = 1,$onPush = true)
    {

        //TODO:: 错误码
        if (!$this->checkBagSpace()) {
            return 'NotEnoughBagSpace';
        }
        $itemData = $this->getBagByItemId($itemId);

        $itemData['CurCount'] = $itemData['CurCount'] ?? 0;
        $num = empty($itemData) ? $num : ($itemData['CurCount'] + $num);
//        需要验证可以叠加数量  进行创建新的格子
        $onSpace = $this->getOnSpace($itemId,$num);

        $data = [
            'CurCount' => $num,
            'uid' => $this->uid,
            'OnSpace' => $onSpace,
            'id' => (int)$itemId
        ];
        $value = $this->getGoodsStatus((array)$itemData,1,$num);
        //更新身价
        if ($value !== false) {
            $this->updateStatus($value);
        }

        $bagKeyIsSet = $this->cache->client()->exists($this->bagKeyPrefix . $itemId);
        $setRes = $this->cache->stringSet($this->bagKeyPrefix . $itemId,$data);
        if (!$bagKeyIsSet) {
            if ($setRes) {
                $res = $this->cache->hashSet($this->bagListKey,$itemId,$this->bagKeyPrefix . $itemId);
            } else {
                return false;
            }
        } else {
            $res = $setRes;
        }
        if ($res) {
            if(in_array($itemId,$this->GoldType)){
                $UserEvent = new UserEvent($this->uid);
                $UserEvent->GoldChangedResultEvent();
            } else {
                if ($onPush) {
                    $eventData = ['uid' => $this->uid,'evenFunc' => 'pushChange','item' => [$data['id'] => $data['CurCount']]];
                    event(BagAddEvent::class,$eventData);
                }
            }
            return true;
        }

    }

    /**
     * 背包减少商品
     * @param $itemId
     * @param Int $num
     * @return bool
     */
    public function delBag($itemId,Int $num = 1)
    {
        //TODO::错误码
        $itemData = $this->getBagByItemId($itemId);
        if (empty($itemData)) {
            return false;
        }
        $num = $itemData['CurCount'] - abs($num);
        if ($num < 0) {
            return false;
        }
//        需要验证可以叠加数量  进行创建新的格子
        $onSpace = $this->getOnSpace($itemId,$num);
        $data = [
            'CurCount' => $num,
            'OnSpace' => $onSpace,
            'uid' => $this->uid,
            'id' => $itemId
        ];
        $key = $this->bagKeyPrefix . $itemId;
        if ($num == 0 && !in_array($itemId,$this->GoldType)) {
            //不是金钱类型的 删掉这个key
            $delRes = $this->cache->stringDel($key);
            if ($delRes) {
                $hashRes = $this->cache->hashHdel($this->bagListKey,$itemId);
                if (!$hashRes) {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            $setRes = $this->cache->stringSet($key,$data);
            if (!$setRes) {
                return false;
            }
        }

        $value = $this->getGoodsStatus((array)$itemData,2,$num);

        //更新身价
        if ($value !== false) {
            $this->updateStatus($value);
        }
        if(in_array($itemId,$this->GoldType)){
            $UserEvent = new UserEvent($this->uid);
            $UserEvent->GoldChangedResultEvent();
        } else {
            $eventData = ['uid' => $this->uid,'item' => [$data['id'] => $data['CurCount']]];
            event(BagDelEvent::class,$eventData);
        }
        return true;

    }

    /**
     * 批量减道具
     * @param $items [['Id' => num]]
     */
    public function batchDelBag($items)
    {
        foreach ($items as $itemKey => $item) {
            $this->delBag($itemKey,$item);
        }
//        $eventData = ['uid' => $this->uid,'evenFunc' => 'pushBag'];
//        event(BagAddEvent::class,$eventData);
    }
    /**
     * 获取商品占格数量
     * @param $itemId
     * @param $num
     * @return bool|float
     */
    private function getOnSpace($itemId,$num)
    {
        $itemInfo = $this->item->getItemByid($itemId);
        $count = (int)$itemInfo['Count'];
        if (!empty($itemInfo) && $count > 0) {
            $space = ceil($num / $itemInfo['Count']);
            return $space == 0 ? 1 : $space;
        }
        return 0;

    }
    /**
     * 验证叠加数量
     */
    private function checkOverlyingNum($itemsId,$num)
    {
        $itemInfo = $this->item->getItemByid($itemsId);

        if (!empty($itemInfo)) {
            return $itemInfo;
        }
        return [];
    }

    /**
     * 获取物品身价值
     * @param array $goodsData
     * @param Int $type 1添加 2减少
     * @param $curCount 商品数量
     */
    private function getGoodsStatus(Array $goodsData,Int $type = 1,$curCount)
    {
        //如果身价值字段 为空 或者为0 直接返回false 不继续算
        if (empty($goodsData['Status'])) {
            return false;
        }
        if ($type == 1) {
            //加入的身价值
            //如果不叠加 并且 数量是1
            if ($goodsData['Superposition'] != '1' && $curCount == '1') {
                return (int)$goodsData['Status'];
            }
            //如果叠加
            if ($goodsData['Superposition'] == '1') {
                return (int)$goodsData['Status'];
            }
            return false;
        } else {
            //减少时候的身价值
            if ($goodsData['ReduceStatus'] == 1) {
                return $goodsData['Status'] * -1;
            }
            return false;
        }

    }

    /**
     * 更新身价值
     * @param String $value 身价值
     */
    private function updateStatus(String $value)
    {
        $role = new Role();
        $role->updateShenjiazhi($this->uid,$value);
    }

    /**
     * 获取用户背包道具的数量
     * @param $itemid 道具id
     * @return int|mixed
     */
    public function getCountByItemId($itemid)
    {
        $data = $this->getBagByItemId($itemid);
        if($data){
            $Count = $data['CurCount'];
        }else{
            $Count = 0;
        }
        return $Count;
    }

    /**
     * 验证道具数量是否满足
     * @param $ItemId
     * @param $Count
     * @return bool
     */
    public function checkCountByItemId($ItemId,$Count)
    {
        $num = $this->getCountByItemId($ItemId);
        if($num >= $Count){
            return true;
        }else{
            return false;
        }

    }
}
