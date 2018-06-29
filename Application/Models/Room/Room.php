<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/22
 * Time: 上午10:30
 */

namespace App\Models\Room;


use App\Models\BagInfo\Bag;
use App\Models\Excel\Star;
use App\Models\Model;
use App\Traits\CacheTrait;
use App\Traits\MongoTrait;
use App\Models\Excel\Room as ExcelRoom;

class Room extends Model
{
    use MongoTrait,CacheTrait;

    private $mongoTable = 'ckzc.room';
    private $mongoListTable = 'ckzc.roomList';
    private $excelRoom;
    private $star;
    private $uid;
    const initRoomKey = 101;//初始化赠送的roomkey
    const roomListKey = 'roomList:uid:';//房间列表的key

    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->excelRoom = new ExcelRoom();
        $this->star = new Star();
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
        parent::__construct();
    }

    
    /**
     * 初始化的时候要送一个账户 一个住宅
     */
    public function init()
    {
        $roomInfo = $this->excelRoom->getRoomByKey(self::initRoomKey);
        return $initRoom = $this->createRoom($roomInfo);
    }

    /**
     * 家具升星
     * @param $itemId
     */
    public function upgradeFurniture($itemId)
    {
        $roomInfo = $this->getUseRoom(false);//获取当前入住的住宅信息
        $furniture = '';
        foreach ($roomInfo['config'] as $config) {
            if ($config['item'] == $itemId) {
                //当前要升级的家具
                $furniture = $config;
                break;
            }
        }
        $shouldLevel = $furniture['level'] + 1;
        //查找升级需要使用的材料
        //读表
        $upgradeData = $this->star->getFieldByStarLv($shouldLevel);
        $bag = new Bag((int)$this->uid);
        $needItem = explode(';',$upgradeData['NeedItem']);
        $newNeedItem = [];
        foreach ($needItem as $v) {
            $temp = explode(',',$v);
            $newNeedItem[$temp['0']] = $temp;
        }
        $bagData = $bag->getBag();
        //判断是否数量足够
        //NotEnoughItem 道具数量不足
        $upgradeItems = array_column($newNeedItem,'0');
        $needBagData = [];
        foreach ($bagData as $bagV) {
            if (isset($bagV['id']) && in_array($bagV['id'],$upgradeItems)) {
                //判断数量
                if ($bagV['CurCount'] < $newNeedItem[$bagV['id']]['1']) {
                    //道具数量不足
                    return ['error' => true, 'msg' => 'NotEnoughItem'];
                }
            }
        }
        //减道具
        //更新身价值
//        $bag->
        //升级
        //完成


//        $bag->getCountByItemId();
    }


    /**
     *住宅升级 todo::
     */
    public function upgradeRoom($roomId)
    {
        $roomMId = $this->getRoomId($roomId);
    }
    /**
     * 设置使用的住宅
     * 入住
     */
    public function setUseRoom($roomId)
    {
        $zsetKey = self::roomListKey . $this->uid;
        $roomMId = $this->getRoomId($roomId);
        $member = 'room:_id:' . $roomMId;
        if ($roomMId) {
            return $this->zsetSet($zsetKey,$member,time());
        }
        return false;
    }
    /**
     *获取当前正在使用的住宅
     */
    public function getUseRoom($transform = true)
    {
        $zsetKey = self::roomListKey . $this->uid;
        $useRoomId = $this->zsetGet($zsetKey,0,0,'desc');
        $roomInfo = $this->getRoomByRoomId($useRoomId['0']);
        if ($transform) {
            $roomInfo = $this->transformRoomData($roomInfo);//转换房屋信息
        }
        return $roomInfo;
    }

    /**
     * 更新房屋的信息
     */
    private function updateRoom()
    {

    }
    /**
     * 转换房屋信息 前台需要的
     */
    private function transformRoomData($roomInfo)
    {
        $configsItems = array_column($roomInfo['config'],'item'); //配置家具信息
        $configsLevel = array_column($roomInfo['config'],'level'); //配置家具等级
        $configs = array_combine($configsItems,$configsLevel);
        $data = [
            'uid' => $roomInfo['uid'],
            'roomId' => $roomInfo['roomId'],
            'config' => $configs,
        ];

        return $data;
    }
    /**
     * 获取住宅的id
     */
    private function getRoomId($roomId)
    {
        $data = $this->collection->findOne([
            'uid' => (int)$this->uid,
            'roomId' => $roomId,
        ]);
        if (!empty($data)) {
            return (string)$data['_id'];
        }
        return false;
    }
    /**
     * 获得room信息
     */
    private function getRoomByRoomId($key)
    {
        $roomInfo = $this->stringGet($key);
        return $roomInfo;
    }
    /**
     * 获取当前用户的住宅信息
     *
     */
    public function getRooms()
    {

        $data = [];
        $zsetKey = self::roomListKey . $this->uid;
        $data['0'] = 1;
        $roomIds = $this->zsetGet($zsetKey,0,-1);
        
        if (empty($roomIds)) {
            //没有 mongo获取
            return [];
        }
        foreach ($roomIds as $key) {
            $roomInfo = $this->stringGet($key);
            $data[] = $this->transformRoomData($roomInfo);
        }
        unset($data['0']);
        return $data;
    }

    /**
     * 放到登录的事件中 使用队列执行
     * 加载当前用户的住宅列表
     */
    public function loadRoomList()
    {
        $zsetKey = self::roomListKey . $this->uid;
        $this->zsetLoad($zsetKey);
    }
    /**
     * 创建一个住宅
     * @param $roomInfo
     * @return array|bool
     */
    private function createRoom($roomInfo)
    {
        if (!empty($roomInfo)) {
            $data = $this->createData($roomInfo);
            $res = $this->collection->insertOne($data);
            //放入住宅列表
            if ($res) {
                $mongoId = $res->getInsertedId();
                $this->setRoomList('room:_id:' . (string)$mongoId,true);
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * 创建一个room的列表
     */
    private function createRoomList()
    {
        $listInfo = explode('.',$this->mongoListTable);
        $data = [
            'uid' => (int)$this->uid,
            'items' => []
        ];
        return $this->mongo->{$listInfo['0']}->{$listInfo['1']}->insertOne($data);
    }
    /**
     * 设置room列表
     * @param $roomId mongodId
     * @param bool $isUse
     */
    private function setRoomList($roomId,$isUse = false)
    {
        $score = $isUse == true ? time() : 0;
        $zsetKey = self::roomListKey . $this->uid;
        $this->zsetSet($zsetKey,$roomId,$score);
    }
    /**
     * 创建数据
     * @param $roomInfo
     * @return array
     */
    private function createData($roomInfo)
    {
        $config = explode(';',$roomInfo['Furniture']);
        $configs = [];
        if (!empty($config)) {
            foreach ($config as $k => $c) {
                $temp = explode(',',$c);
                $configs[] = [
                    'position' => $temp['0'],//位置
                    'item' =>$temp['1'] ,//家具
                    'level' => 1,//家具等级
                ];
            }
        }
        $data = [
            'uid' => (int)$this->uid,
            'value' => $roomInfo['Status'],//身价
            'roomId' => $roomInfo['Key'],//roomId
            'level' => 1,//当前房屋等级
            'config' => $configs//房屋配置
        ];
        return $data;
    }

}