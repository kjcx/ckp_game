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
use App\Utility\Cache;

class Room extends Model
{
    use MongoTrait,CacheTrait;

    private $mongoTable = 'ckzc.room';
    private $mongoListTable = 'ckzc.roomList';
    private $excelRoom;
    private $star;
    private $uid;
    private $cache;
    private $roomKey;
    const initRoomKey = 101;//初始化赠送的roomkey
    const roomListKey = 'roomList:uid:';//房间列表的key
    const roomValue = 'social_status';//房间身价值

    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->excelRoom = new ExcelRoom();
        $this->star = new Star();
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
        $this->cache = Cache::getInstance();
        $this->roomKey = 'room:uid:' . $this->uid . ':roomId:';
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
        $theConfigKey = '';
        foreach ($roomInfo['config'] as $key => $config) {
            if ($config['item'] == $itemId) {
                //当前要升级的家具
                $theConfigKey = $key;
                $furniture = $config;
                break;
            }
        }
        $shouldLevel = $furniture['level'] + 1;
        //查找升级需要使用的材料
        //读表
        $upgradeData = $this->star->getFieldByStarLv($furniture['level']);
        $bag = new Bag((int)$this->uid);
        $needItem = explode(';',$upgradeData['NeedItem']);
        $newNeedItem = [];
        foreach ($needItem as $v) {
            $temp = explode(',',$v);
            $newNeedItem[$temp['0']] = $temp;
        }
        $gold = explode(',',$upgradeData['Cost']);
        //判断是否数量足够
        //NotEnoughItem 道具数量不足
        //判断钱
        $batchItems = [];
        foreach ($newNeedItem as $item) {
            $checkRes = $bag->checkCountByItemId($item['0'],$item['1']);
            if ($checkRes == false) {
                return ['error' => true,'msg' => 'NotEnoughItem'];
            }
            $batchItems[$item['0']] = $item['1'];
        }

        //判断钱
        $checkGoldRes = $bag->checkCountByItemId($gold['0'],$gold['1']);
        if ($checkGoldRes == false) {
            return ['error' => true,'msg' => 'NotEnoughMoney'];
        }
//        减道具
        $bag->batchDelBag($batchItems);
        //扣钱
        $bag->delBag($gold['0'],$gold['1']);
        //更新身价值
        $updateValueRes = $this->updateValue($upgradeData['Status']);
        if ($updateValueRes) {
            return ['error' => true,'msg' => 'Error'];
        }
//        $bag->
        //升级
        $roomInfo['config'][$theConfigKey]['level'] = $shouldLevel;
        $roomInfo['value'] += $upgradeData['Status'];
        $updateRoomRes = $this->updateRoom($roomInfo['roomId'],$roomInfo);
        if ($updateRoomRes) {
            return [$itemId => $shouldLevel];
            return true;
        }
        //完成
        return false;
    }

    /**
     * todo::暂时不能卖
     * 出售住宅
     * @param $roomId
     * @return array|bool
     */
    public function sellRoom($roomId)
    {
        $room = $this->getRoomByRoomId($roomId);
        if ($room == false) {
            //没有该住宅
            return ['error' => true,'msg' => 'RoomNotHave'];
        }

        return [];
    }

    /**
     * 购买住宅
     * @param $roomId
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function buyRoom($roomId)
    {
        $room = $this->getRoomByRoomId($roomId);
        if ($room) {
            //已经购买
            return ['error' => true,'msg' => 'RoomBuys'];
        }
        $roomInfo = $this->excelRoom->getRoomByKey($roomId);
        if (empty($roomInfo)) {
            return ['error' => true,'msg' => 'RoomNotHave'];

        }
        $needItem = [];
        $gold = explode(',',$roomInfo['Cost']);
        //扣道具
        $bag = new Bag((int)$this->uid);
        $roomInfo['NeedItem'] = explode(';',$roomInfo['NeedItem']);
        foreach ($roomInfo['NeedItem'] as $v) {
            $temp = explode(',',$v);
            $res = $bag->checkCountByItemId($temp['0'],$temp['1']);
            if ($res == false) {
                //道具不足
                return ['error' => true,'msg' => 'NotEnoughItem'];
            }
            $needItem[$temp['0']] = $temp['1'];
        }
        $bag->batchDelBag($needItem);
        //扣钱
        $bag->delBag($gold['0'],$gold['1']);
        //创建住宅
        $createRes = $this->createRoom($roomInfo);
        if ($createRes) {
            $roomInfo = $this->getRoomByRoomId($roomId);
            return $this->transformRoomData($roomInfo);
        }
        return ['error' => true,'msg' => 'Error'];
    }

    /**
     * 设置使用的住宅
     * 入住
     */
    public function setUseRoom($roomId)
    {
        $zsetKey = self::roomListKey . $this->uid;
        $room = $this->getRoomByRoomId($roomId);
        if ($room) {
            if ($this->cache->zsetZadd($zsetKey,$roomId,time())) {
                return $this->transformRoomData($room);
            }
        }
        return false;
    }
    /**
     *获取当前正在使用的住宅
     */
    public function getUseRoom($transform = true)
    {
        $zsetKey = self::roomListKey . $this->uid;
        $useRoomId = $this->cache->client()->zRevRange($zsetKey,0,0);
        $roomInfo = $this->getRoomByRoomId($useRoomId['0']);
        if ($transform) {
            $roomInfo = $this->transformRoomData($roomInfo);//转换房屋信息
        }
        return $roomInfo;
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
     * 更新住宅信息
     * @param $roomId
     * @param $data
     * @return bool|int
     */
    private function updateRoom($roomId,$data)
    {
        $roomKey = $this->roomKey . $roomId;
        return $this->cache->stringSet($roomKey,$data);
    }
    /**
     * todo::触发事件
     * 更新当前用户的住宅身价值
     * @param $value
     */
    private function updateValue($value)
    {
        //加整个身价
        $zsetKey = self::roomListKey . $this->uid;
        $oldValue = $this->cache->client()->zScore($zsetKey,self::roomValue);
        $score = $oldValue + $value;
        return $this->cache->zsetZadd($zsetKey,self::roomValue,$score);
    }
    /**
     * 获得room信息
     */
    private function getRoomByRoomId($roomId)
    {
        $key = $this->roomKey . $roomId;
        $room = $this->cache->stringGet($key);
        return $room;
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
        $roomIds = $this->cache->client()->zRevRange($zsetKey,0,-1);
        if (empty($roomIds)) {
            return [];
        }
        foreach ($roomIds as $roomId) {
            if ($roomId != self::roomValue) {
                //排除掉身价值
                $roomInfo = $this->getRoomByRoomId($roomId);
                $data[] = $this->transformRoomData($roomInfo);
            }

        }
        unset($data['0']);
        return $data;
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
            $key = $this->roomKey . $data['roomId'];
            $res = $this->cache->stringSet($key,$data);
            //放入住宅列表
            if ($res) {
                $this->setRoomList($data['roomId'],true);
                $this->updateValue($data['value']);
                return true;
            }
            return false;
        }
        return false;
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
        $this->cache->zsetZadd($zsetKey,$roomId,$score);
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
                    'value' => 1,//家具身价值
                ];
            }
        }
        $data = [
            'uid' => (int)$this->uid,
            'value' => is_numeric($roomInfo['Status']) ? $roomInfo['Status'] : 0,//身价
            'roomId' => $roomInfo['Key'],//roomId
            'level' => 1,//当前房屋等级
            'config' => $configs//房屋配置
        ];
        return $data;
    }

}