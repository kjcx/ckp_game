<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/10
 * Time: 下午1:19
 * 背包类
 */

namespace App\Models\BagInfo;

use App\Event\UserEvent;
use App\Models\Model;
use App\Models\User\Role;
use App\Traits\MongoTrait;
use think\Db;
use App\Models\BagInfo\Item;

class Bag extends Model
{
    use MongoTrait;

    private $uid;
    private $bagInfo;
    private $mongoTable = 'ckzc_data.user_bag';
    private $item; //item类为了验证信息   依赖
    private $initData; //初始化信息
    private $MaxCellNumber;
    private $GoldType = [2,6];//金币变化通知

    public function __construct(int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
        //依赖进来 但是不需要注入
        $this->item = new Item();
        $this->initData = new Init();
        $this->MaxCellNumber = 999;
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
    }

    /**
     * 切库
     * @param $database
     */
    private function switchDatabase(String $database = 'ckzc_data')
    {
        Db::setConfig(['database' => $database]); //切库
    }
    /**
     * 获取背包信息
     * @return array
     */
    public function getBag()
    {
        $data = $this->collection->findOne(['uid' => $this->uid]);
        if (!empty($data) && isset($data['data'])) {
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
        //生成背包数据
        //绑金 初始道具  初始创客币 初始金币
        $initData['goldBind']; //绑金
        $initData['item']; //初始道具
        $initData['coin']; //初始创客币
        $initData['gold']; //初始金币
        $goldBindData = $this->item->getItemByid($initData['goldBind']['id']);
        $itemData = $this->item->getItemByid($initData['item']['id']);
        $coinData = $this->item->getItemByid($initData['coin']['id']);
        $goldData = $this->item->getItemByid($initData['gold']['id']);
        $bagData = [
            $goldBindData['Id'] => [
                'id' => $goldBindData['Id'],
                'OnSpace' => $this->getOnSpace($goldBindData['Id'],$initData['goldBind']['count']),
                'CurCount' => $initData['goldBind']['count']
            ],
            $itemData['Id'] => [
                'id' => $itemData['Id'],
                'OnSpace' => $this->getOnSpace($itemData['Id'],$initData['item']['count']),
                'CurCount' => $initData['item']['count']
            ],
            $coinData['Id'] => [
                'id' => $coinData['Id'],
                'OnSpace' => $this->getOnSpace($coinData['Id'],$initData['coin']['count']),
                'CurCount' => $initData['coin']['count']
            ],
            $goldData['Id'] => [
                'id' => $goldData['Id'],
                'OnSpace' => $this->getOnSpace($goldData['Id'],$initData['gold']['count']),
                'CurCount' => $initData['gold']['count']
            ],
        ];

        $bagInfo = [
            'uid' => $this->uid,
            'data' => $bagData
        ];

        $res = $this->collection->insertOne($bagInfo);
        if ($res->isAcknowledged()) {
            return true;
        }
        return false;
    }


     /**
     * 获取背包的单个商品
     * @param $itemId
     * @return array
     */
    public function getBagByItemId($itemId)
    {
        $data = $this->collection->findOne(['uid' => $this->uid]);
        if (isset($data['data'][$itemId])) {
            return $data['data'][$itemId];
        }
        return [];
    }

    public  function getBagByItemIds($itemIds)
    {
        $data = $this->getBag();
        $items = $data['data'];
        var_dump($items);
        if($items){
            $arr = [];
            foreach ($itemIds as $id) {
                if(isset($items[$id]['CurCount'])){
                    $arr[$id] = $items[$id]['CurCount'];
                }else{
                    $arr[$id] = 0;
                }
            }
            return $arr;
        }
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
     * 背包增加商品
     * @param $itemId 商品id
     * @param $num 商品数量
     */
    public function addBag($itemId,Int $num = 1)
    {

        //TODO:: 错误码
        if (!$this->checkBagSpace()) {
            return '背包格子已满';
        }
        $itemData = $this->getBagByItemId($itemId);

        $itemData['CurCount'] = $itemData['CurCount'] ?? 0;
        $num = empty($itemData) ? $num : ($itemData['CurCount'] + $num);
//        需要验证可以叠加数量  进行创建新的格子
        $onSpace = $this->getOnSpace($itemId,$num);

        $data = [
            'CurCount' => $num,
            'OnSpace' => $onSpace,
            'id' => $itemId
        ];
        $value = $this->getGoodsStatus((array)$itemData,1,$num);
        //更新身价
        if ($value !== false) {
            $this->updateStatus($value);
        }
        if(in_array($itemId,$this->GoldType)){
            $UserEvent = new UserEvent($this->uid);
            $UserEvent->GoldChangedResultEvent();
        }
        $result = $this->collection->findOneAndUpdate(['uid' => $this->uid],[
            '$set' => [
                'data.' . $itemId => $data
            ]
        ]);
        return empty($result) ? false : true;
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
        $num = $itemData['CurCount'] - $num;
        if ($num < 0) {
            return false;
        }
        $filter = ['uid' => $this->uid]; //条件
        $update = [];
//        需要验证可以叠加数量  进行创建新的格子
        $onSpace = $this->getOnSpace($itemId,$num);
        $data = [
            'CurCount' => $num,
            'OnSpace' => $onSpace,
            'id' => $itemId
        ];
        if ($num == 0) {
            $update['$unset'] = [
                'data.' . $itemId => 1
            ];
        } else {
            $update['$set'] = [
                'data.' . $itemId => $data
            ];
        }

        $value = $this->getGoodsStatus((array)$itemData,2,$num);

        $result = $this->collection->findOneAndUpdate($filter,$update);
        //更新身价
        if ($value !== false) {
            $this->updateStatus($value);
        }
        if(in_array($itemId,$this->GoldType)){
            $UserEvent = new UserEvent($this->uid);
            $UserEvent->GoldChangedResultEvent();
        }
        return empty($result) ? false : true;

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
        if (!empty($itemInfo) && isset($itemInfo['Count'])) {
            $space = ceil($num / $itemInfo['Count']);
            return $space == 0 ? 1 : $space;
        }
        return false;

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
    
}