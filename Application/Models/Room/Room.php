<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/22
 * Time: 上午10:30
 */

namespace App\Models\Room;


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
    private $uid;
    const initRoomKey = 101;//初始化赠送的roomkey
    const roomListKey = 'roomList:uid:';//房间列表的key

    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->excelRoom = new ExcelRoom();
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
    public function getUseRoom()
    {
        $zsetKey = self::roomListKey . $this->uid;
        $useRoomId = $this->zsetGet($zsetKey,0,0,'desc');
        $roomInfo = $this->getRoomByRoomId($useRoomId['0']);
        $roomInfo = $this->transformRoomData($roomInfo);//转换房屋信息
        return $roomInfo;
    }

    /**
     * 转换房屋信息 前台需要的
     */
    private function transformRoomData($roomInfo)
    {
        $configsPosition = array_column($roomInfo['config'],'position'); //配置位置信息
        $configsItem = array_column($roomInfo['config'],'item'); //配置家具信息
        $configs = array_combine($configsPosition,$configsItem);
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
        $roomIds = $this->zsetGet($zsetKey,0,-1);
        if (empty($roomIds)) {
            //没有 mongo获取
            return [];
        }
        foreach ($roomIds as $key) {
            $roomInfo = $this->stringGet($key);
            $data[] = $this->transformRoomData($roomInfo);
        }
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