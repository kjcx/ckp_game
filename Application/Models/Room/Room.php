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
use App\Models\User\Role;
use App\Models\User\UserAttr;
use App\Traits\CacheTrait;
use App\Traits\MongoTrait;
use App\Models\Excel\Room as ExcelRoom;
use App\Utility\Cache;
use MongoDB\BSON\ObjectId;

class Room extends Model
{
    use MongoTrait,CacheTrait;

    private $mongoTable = 'ckzc.room';
    private $mongoListTable = 'ckzc.roomList';
    private $excelRoom;
    private $role;
    private $roomKey;
    private $star;
    private $uid;
    private $cache;
    const initRoomKey = 101;//初始化赠送的roomkey
    const roomListKey = 'roomList:uid:';//房间列表的key
    const roomValue = 'social_status';//房间身价值
    const roomLogList = 'roomLogList:uid:';//拜访升级记录 列表
    const roomLog = 'roomLog:_id:';//拜访升级记录 详情
    const Visit = 1; //拜访
    const BuyRoom = 2; //购买住宅
    const FurnitureStarUp = 3; //家具升星
    const logTimeOut = 604800;//日志保存时间 7天

    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->excelRoom = new ExcelRoom();
        $this->star = new Star();
        $this->role = new Role();//角色对象
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
        $this->cache = Cache::getInstance();
        $this->roomKey = 'room:uid:' . $this->uid . ':roomId:';//room单个key
        parent::__construct();
    }

    
    /**
     * 初始化的时候要送一个账户 一个住宅
     */
    public function init()
    {
        $roomInfo = $this->excelRoom->getRoomByKey(self::initRoomKey);

        $initRoom = $this->createRoom($roomInfo);
        if ($initRoom != false) {
            //更新身价值
            $this->updateValue($initRoom['value']);
            return true;
        }
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
        if ($updateValueRes == false) {
            return ['error' => true,'msg' => 'Error'];
        }
//        $bag->
        //升级
        $roomInfo['config'][$theConfigKey]['level'] = $shouldLevel;
        $roomInfo['value'] += $upgradeData['Status'];
        $updateRoomRes = $this->updateRoom($roomInfo['roomId'],$roomInfo);
        if ($updateRoomRes) {
            //加记录
            $roleInfo = $this->role->getRole($this->uid);
            $this->addLog(self::FurnitureStarUp,$this->uid,$roleInfo['nickname'],$upgradeData['Status']);
            return [$itemId => $shouldLevel];
        }
        //完成
        return false;
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
        //更新身价值
        if ($createRes != false) {
            //更新身价值
            $updateValueRes = $this->updateValue($createRes['value']);//
            $roleInfo = $this->role->getRole($this->uid);
            $this->addLog(self::BuyRoom,$this->uid,$roleInfo['nickname'],$createRes['value']);
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
        $useRoomId = $this->cache->client('write')->zRevRange($zsetKey,0,0);
        $roomInfo = $this->getRoomByRoomId($useRoomId['0']);
        if ($transform) {
            $roomInfo = $this->transformRoomData($roomInfo);//转换房屋信息
        }
        return $roomInfo;
    }

    /**
     * 获取日志
     */
    public function getLog()
    {
        $hashKey = self::roomLogList . $this->uid;
        $keys = $this->cache->client()->hGetAll($hashKey);
        $data = [];
        foreach ($keys as $k => $key) {
            $item = $this->cache->stringGet($key);
            if ($item == false) {
                $this->cache->hashHdel($hashKey,$k);
            } else {
                $data[] = $item;
            }
        }
        return $data;
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
     *     string RoleId=1;头像
    string Icon=2;姓名
    string Name=3;性别
    int32 Sex=4;vip级别
    string VipLevel=5;vip级别
    int64 SocialStatus=6;身价
    repeated int32 Avatar=7;avatar信息
    int64 RoomPraiseTime=8;房间的点赞数
    int32 Achieve=9;称号
    int32 VipId=10;天使玩家与先锋玩家
     */

    /**
     * 拜访住宅
     * @param $toRoleId 要拜访人的uid
     */
    public function visitRoom($visitId,$toRoleId)
    {
        $this->uid = $toRoleId;
        $roleInfo = $this->role->getRole($visitId);
        $this->addLog(self::Visit,$visitId,$roleInfo['nickname'],0);//增加拜访记录
        $visitInfo = $this->role->getRole($toRoleId);
        $attr = new UserAttr();
//        $avatar = $attr->getUserAttr($toRoleId);
        $avatar = [
            "Body" => 1145,
            "Head" => 1144,
            "Pants" => 1146
        ];//todo 等待修改
        $avatar = array_values($avatar);
        $visitinfo = [
            'RoleId' => $visitInfo['uid'],
            'Icon' => $visitInfo['icon'],
            'Name' => $visitInfo['nickname'],
            'Sex' => $visitInfo['sex'],
            'VipLevel' => $visitInfo['vip'],
            'SocialStatus' => $visitInfo['shenjiazhi'],
            'Avatar' => $avatar,
            'RoomPraiseTime' => 100,//房间点赞数
            'Achieve' => $visitInfo['nickname'],//称号
            'VipId' => $visitInfo['nickname'],//vip id 天使玩家与先锋玩家
        ];
        return [
            'room' => $this->getUseRoom(),
            'visitinfo' => $visitinfo
        ];
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
        $role = new Role();
        $role->updateShenjiazhi($this->uid,$value);
        $this->cache->zsetZadd($zsetKey,self::roomValue,$score);
        return $role->getShenjiazhi($this->uid);
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
                return $data;
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

    /**
     * 拜访记录
     * 购买记录
     * 家具升星记录
     * @param $type
     * @param $roleId
     * @param $roleName
     * @param $value
     */
    private function addLog($type,$roleId,$roleName,$value)
    {
        $key = self::roomLog . (string)(new ObjectId());//详情key
        $hashKey = self::roomLogList . $this->uid; //列表key
        //定义数据
        $data = [
            'roleName' => (string)$roleName,//角色名字
            'roleId' => (string)$roleId,//角色id
            'time' => 1,//次数
            'type' => (int)$type,//日志类型
            'value' => (int)$value,//身价值
            'unixTime' => time(),//操作时间
        ];
        $this->cache->stringSet($key,$data,self::logTimeOut);
        $this->cache->hashSet($hashKey,time(),$key);
        return true;
    }

}