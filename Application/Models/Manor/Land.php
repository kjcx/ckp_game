<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/17
 * Time: 上午11:34
 */
namespace App\Models\Manor;

use App\Models\BagInfo\Bag;
use App\Models\Execl\Fram;
use App\Models\Execl\GameConfig;
use App\Models\Model;
use App\Models\User\Role;
use App\Traits\MongoTrait;
use App\Traits\UserTrait;

class Land extends Model
{
    use MongoTrait,UserTrait;

    const SoilNotExploit = 0;//庄园 土地未开发
    const SoilAlreadyExploit = 1;//土地已开发
    //种子状态
    const SeedlingStage = 1; //幼苗期
    const GrowthStage = 2;//成长期
    const MatureStage = 3;//成熟期
    const Compost = 163;//肥料

    public $mongoTable = 'ckzc_data.manor';
    private $item;

    public function __construct($uid)
    {
        parent::__construct();
        $this->setUid($uid);
        $this->setRoleInfo();
        $this->collection = $this->getMongoClient();
        $this->item = new \App\Models\Execl\Item();
    }

    /**
     * 初始化地块 也是初始化庄园信息
     */
    public function initLand()
    {
        $uid = $this->getUid();
        $landInfo = $this->collection->findOne(['uid' => $uid]);
        $role = new Role();
        $roleInfo = $role->getRole($uid);
        if ($landInfo) {
            //当前有地块信息
            return false;
        }
        $landData = [];
        $landData['uid'] = $uid;
        $landData['time'] = time();
        $landData['name'] = $roleInfo['nickname'];
        $landData['manor'] = [];
        for ($i = 1; $i < 17; $i++) {
            $landItem = $this->createLandItem($i);
            $landItem['SoilState'] = $i < 5 ? self::SoilAlreadyExploit : self::SoilNotExploit;
            $landData['manor'][] = $landItem;
        }
        $result = $this->collection->insertOne($landData);
        if ($result->isAcknowledged()) {
            return true;
        }
        return false;
    }

    /**+
     * 获取土地 可以获取当前用户的土地  也可以获取任意用户的土地
     * @param bool $uid
     * @return array|null|object
     */
    public function getLand($uid = false)
    {
        $uid = $uid == false ? $this->getUid() : $uid;
        $role = new Role();
        $roleInfo = $role->getRole($uid);
        $landInfo = $this->collection->findOne(['uid' => (int)$uid]);
        if (!empty($landInfo['manor'])) {
            foreach ($landInfo['manor'] as $key => $value) {
                $landInfo['manor'][$key]['UserName'] = $roleInfo['nickname'];
                if ($value['SemenId'] > 0) {
                    //种植了作物  计算作物的时间
                    $landInfo['manor'][$key]['PhasesStatus'] = $this->calcCrop($value);
                }
            }
            $landInfo['name'] = $roleInfo['nickname'];
            $landInfo['time'] = time();
            return $landInfo;
        }

    }
    /**
     * 获得地块详情
     */
    private function getLoadDetail()
    {
        $lands = $this->getLand();
        $lands['open'] = 0;//开放地块
        foreach ($lands['manor'] as $key => $land) {
            if ($land['SoilState'] == self::SoilAlreadyExploit) {
                //已开发
                $lands['open'] += 1;
            }
        }
        return $lands;
    }

    /**
     * 收获
     * @param $lands 地块IDS
     */
    public function harvest($lands)
    {
        $myLands = $this->getLand();
        $newLands = [];
        foreach ($myLands['manor'] as $land) {
            if (in_array($land['Id'],$lands)) {
                $newLands[] = $land;
            }
        }
        $harvests = [];
        $bags = [];
        foreach ($newLands as $land) {
            $harvest = [];
            if ($land['StealTime'] == 0) {
                //没被偷过
                $cropInfo = $this->createFruit($land['SemenId'],isset($land['Profit']) ?? 0);
                $harvest['Id'] = $land['Id'];
                $harvest['SemenId'] = $cropInfo['crop'];
                $harvest['Count'] = $cropInfo['num'];
                $harvest['Time'] = 0;
            } else {
                $harvest['Id'] = $land['Id'];
                $harvest['SemenId'] = $land['Crop'];//作物的ID  被偷过才有
                $harvest['Count'] = $land['Crop_num'];//作物的数量  被偷过才有
                $harvest['Time'] = $land['StealTime'];
            }
            $harvests[] = $harvest;
            if (isset($bags[$harvest['SemenId']])) {
                $bags[$harvest['SemenId']] = $bags[$harvest['SemenId']] + $harvest['Count'];
            } else {
                $bags[$harvest['SemenId']] = $harvest['Count'];
            }
        }
        $bag = new Bag($this->getUid());
        $bag->batchAddBag($bags);//批量添加进背包
        //清除地块内容
        foreach ($newLands as $land) {
            $this->eradicate($land['Id'],$this->getUid());
        }
        return $harvests;
    }

    /**
     * 创建果实
     * @param $seedId 种子ID
     * @param $profit 收益
     * @return array
     */
    private function createFruit($seedId,$profit)
    {
        $itemInfo = $this->item->getItemById($seedId);
        $itemInfo['Harvest'] = explode(',',$itemInfo['Harvest']);
        $max = ($itemInfo['Harvest']['1']) * (1 + $profit);
        $num = mt_rand(1,ceil($max));
        return ['crop' => $itemInfo['Harvest']['0'],'num' => $num];
    }
    /**
     * 铲除地块
     * @param $landId
     * @param $uid
     * @return array|bool
     */
    public function eradicate($landId,$uid)
    {
        if ($this->getUid() != $uid) {
            return ['error' => true,'msg' => 'OneselfEradicate'];
        }
        $filter = ['uid' => $this->getUid()];
        $update = ['$set' => [
            'manor.' . ($landId - 1) . '.PlantDate' => 0,
            'manor.' . ($landId - 1) . '.SemenId' => 0,
            'manor.' . ($landId - 1) . '.PhasesStatus' => 0,
            'manor.' . ($landId - 1) . '.StealTime' => 0,
            'manor.' . ($landId - 1) . '.Crop' => 0,
            'manor.' . ($landId - 1) . '.Crop_num' => 0
        ]];

        $result = $this->collection->findOneAndUpdate($filter,$update);
        if ($result) {
            return $landId;
        }
        return ['error' => true,'msg' => 'Error'];
    }
    /**
     * 获取一块地的详情
     * @param $landId
     * @param bool $uid
     * @return mixed
     */
    public function getlandOne($landId,$uid = false)
    {
        $uid = $uid == false ? $this->getUid() : $uid;
        $lands = $this->getLand($uid);
        return $lands['manor'][$landId - 1];
    }

    /**
     * 庄园种植
     * @param $landId 地块ID
     * @param $semenId 种子ID
     */
    public function plant($landId,$semenId)
    {
        //验证当前背包是否有这个种子
        $bagSeed = $this->getBag()->checkBagHasItemById($semenId);
        if ($bagSeed == false) {
            //没有这个种子
            return ['error' => true,'msg' => 'NotItemInBag'];
        }
        if ($bagSeed['CurCount'] < 1 )
        {
            //道具数量不足
            return ['error' => true,'msg' => 'NotEnoughItem'];
        }
        $lands = $this->getLoadDetail();
        if (isset($lands['manor'][$landId-1]) && $lands['manor'][$landId-1]['SoilState'] == self::SoilAlreadyExploit) {
            //
            $update = [
                '$set' => [
                    'manor.' . ($landId - 1) . '.PlantDate' => time(),
                    'manor.' . ($landId - 1) . '.SemenId' => $semenId,
                    'manor.' . ($landId - 1) . '.PhasesStatus' => self::SeedlingStage
                ]
            ];
            $filter = ['uid' => $this->getUid()];
            $result = $this->collection->findOneAndUpdate($filter,$update);
            if ($result) {
                $this->getBag()->delBag($semenId,1);
                $land = $this->getLand();
                return (array)$land['manor'][$landId - 1];
            }
        }
        //地块未开发
        return ['error' => true,'msg' => 'SoilNotExploit'];
    }

    /**
     * 计算作物的状态
     * @param $landDetail
     */
    private function calcCrop($landDetail)
    {
        if ($landDetail['SemenId'] == 0) {
            return 0;
        }
        $seedInfo = $this->item->getItemById($landDetail['SemenId']);
        $seedStatus = time() - $landDetail['PlantDate'];
        if (($seedStatus / ($seedInfo['MatureTime'] * 60)) > 1) {
            //成熟
            return self::MatureStage;
        }
        if (($seedStatus / ($seedInfo['MatureTime'] * 60)) >= 0.3) {
            //成长期
            return self::GrowthStage;
        }
        //幼苗期
        return self::SeedlingStage;
    }
    /**
     * 解锁土地
     */
    public function unlockLand($landId)
    {

        $this->getUid();
        $lands = $this->getLoadDetail();
        //判断等级是否可以解锁
        $config = new GameConfig();
        $upgradeConf = $config->getInfoByField('SiolMoney');
        $upValue = explode(';',$upgradeConf['value']);
        $shouldLand = $lands['open'] - 4; //应该升级到的地块
        $upValue = explode(',',$upValue[$shouldLand]);
        if ($this->roleInfo['level'] < $upValue['0']) {
            //等级不够 不能解锁地块
            return ['error' => true,'msg' => 'NeedLevel'];
        }

        //判断钱是否够
        $bag = new Bag($this->getUid());
        $price = $upValue['2'];
        $money = $bag->getBagByItemId($upValue['1']);
        if (empty($money) || $money['CurCount'] < $price) {
            return ['error' => true,'msg' => 'NotEnoughMoney'];
        }
        //判断钱是否够end
        //扣钱
        $bag->delBag($upValue['1'],$price);
        //扣钱end
        //更新地块
        $updateRes = $this->uploadLand($landId);
        if ($updateRes) {
            //更新身价值 TODO::地块身价值

            return $landId;
        }
        return ['error' => true,'msg' => 'NotEnoughMoney'];
        //end
    }

    /**
     *更新地块信息
     */
    private function uploadLand($landId,$uid = false)
    {
        $uid = $uid == false ? $this->getUid() : $uid;
        $result = $this->collection->findOneAndUpdate(['uid' => $uid],[
            '$set' => [
                'manor.' . ($landId - 1) . '.SoilState' => self::SoilAlreadyExploit,
            ]
        ]);
        return empty($result) ? false : true;


    }
    /**
     * 土地升级
     */
    public function upgradeLand($landId)
    {
        $bag = new Bag($this->getUid());
        $lands = $this->getLand();
        //获取当前地块等级
        $nowLevel = $lands['manor'][$landId - 1]['SoilLevel'];
        $shouldLevel = $nowLevel + 1;
        //读取需要升级地块的钱
        $fram = new Fram();
        $upgradeLandInfo = $fram->getInfoById($shouldLevel);
        if (empty($upgradeLandInfo)) {
            return ['error' => true, 'msg' => 'Error'];
        }
        $money = explode(',',$upgradeLandInfo['Cost']);
        //判断当前等级是否可以升级
        if ($this->roleInfo['level'] < $upgradeLandInfo['NeedLv']) {
            return ['error' => true, 'msg' => 'NeedLevel'];
        }
        //扣钱
        $bagRes = $bag->delBag($money['0'],$money['1']);
        if ($bagRes == false) {
            return ['error' => true, 'msg' => 'NeedLevel'];
        }
        //升级
        //地块信息
        $lands['manor'][$landId - 1]['SoilLevel'] = $upgradeLandInfo['Id'];
        $lands['manor'][$landId - 1]['Profit'] = $upgradeLandInfo['Profit'];
        $res = $this->collection->findOneAndUpdate(['uid' => $this->getUid()],[
            '$set' => [
                'manor.' . ($landId - 1) . '.SoilLevel' => $upgradeLandInfo['Id'],
                'manor.' . ($landId - 1) . '.Profit' => $upgradeLandInfo['Profit'],
            ]
        ]);
        //更新身价值
        if ($res) {
            //TODO::还没做更新身价值

            return $lands['manor'][$landId - 1];
        }

        //返回
    }
    /**
     *初始化一个地块
     */
    private function createLandItem($id)
    {

        $landItem = [
                'Id' => $id,//地块ID
                'PlantDate' => 0,//种植时间
                'SemenId' => 0,//查表 种子ID
                'StatusTime' => 0, //异常状态时间
                'Status' => 0,//异常状态
                'PhasesStatus' => 0,//植物当前第几阶段
                'StealTime' => 0,//被偷取几次
                'SoilState' => 0,//土地状态
//                'UserName' => '傅乐心',
                'SoilLevel' => 1,//土地等级
                'Profit' => 0, //收益加层
                'Crop' => 0,//作物的ID  被偷过才有
                'Compost' => 0,//是否使用肥料
                'Crop_num' => 0//作物的数量  被偷过才有
        ];
        return $landItem;
    }

    /**
     * 使用肥料
     */
    public function useCompost($landId)
    {
        $res = $this->getBag()->delBag(self::Compost,1);
        if ($res == false) {
            //没肥料
            return ['error' => true, 'msg' => 'NotEnoughItem'];
        }
        $myLands = $this->getLand();
        $myLands['manor'][$landId - 1];
        $myLands['manor'][$landId - 1]['Compost'] = self::Compost;
        $result = $this->collection->findOneAndUpdate(['uid' => $this->getUid()],[
            '$set' => [
                'manor.' . ($landId - 1) . '.Compost' => self::Compost]
        ]);
        if ($result) {
            return $myLands['manor'][$landId - 1];
        }
    }

    /**
     * 随机请求庄园
     */
    public function randLand()
    {
        $data = $this->mysql->orderBy("RAND()")->getOne('ckzc_role','uid');
        return $this->getLand($data['uid']);
//        return $this->getLand(36);
    }

    /**
     * 偷菜
     * @param $uid 被偷人的uid
     * @param $landIds 偷的地块
     */
    public function steal($uid,$landIds)
    {
        //返回数据
        $stealLand = [];
        //获得地块
        $lands = $this->getLand($uid);
        //查询单一能被偷次数
        $gameConfig = new GameConfig();
        $SingleStealTime = $gameConfig->getInfoByField('SingleStealTime');
        $MaxStealTime = $gameConfig->getInfoByField('MaxStealTime');
        $MaxStealTime = $MaxStealTime['value'];
        $SingleStealTime = $SingleStealTime['value'];
        //循环判断是否可以被偷
        $filter = [
            'uid' => (int)$uid
        ];
        $update = [
            '$set' => []
        ];
        foreach ($lands['manor'] as $land) {
            if (in_array($land['Id'],$landIds)) {
                //在被偷的行列里
                //判断还能不能被偷
                if ($land['StealTime'] >= $MaxStealTime) {
                    $stealLand[] = [
                        'Id' => $land['Id'],
                        'SemenId' => $land['Crop'],
                        'Count' => 0,
                        'Time' => $land['StealTime'],
                    ];
                } else {
                    if ($land['StealTime'] == 0) {
                        //没被偷过 要生成果实
                        $fruit = $this->createFruit($land['SemenId'],$land['Profit']);
                        $stealLand[] = [
                            'Id' => $land['Id'],
                            'SemenId' => $land['Crop'],
                            'Count' => $SingleStealTime, //一次貌似只能偷一个
                            'Time' => $land['StealTime'],
                        ];
                        $update['$set']['manor.' . ($land['Id'] - 1) . '.Crop'] = $fruit['crop'];//果实Id
                        $update['$set']['manor.' . ($land['Id'] - 1) . '.StealTime'] = $land['StealTime'] + 1;//被偷次数
                        $update['$set']['manor.' . ($land['Id'] - 1) . '.Crop_num'] = $fruit['num'] - $SingleStealTime;//剩余果实数量
                    } else {
                        $stealLand[] = [
                            'Id' => $land['Id'],
                            'SemenId' => $land['Crop'],
                            'Count' => ($land['Crop_num'] - $SingleStealTime) >= 0 ? $SingleStealTime : 0, //一次貌似只能偷一个
                            'Time' => $land['StealTime'],
                        ];
                        //被偷过 不需要生成果实
                        $update['$set']['manor.' . ($land['Id'] - 1) . '.StealTime'] = $land['StealTime'] + 1;//被偷次数
                        $update['$set']['manor.' . ($land['Id'] - 1) . '.Crop_num'] =
                            ($land['Crop_num'] - $SingleStealTime) >= 0 ? ($land['Crop_num'] - $SingleStealTime) : 0;//剩余果实数量
                    }

                }
            }
        }
        $res = $this->collection->findOneAndUpdate($filter,$update);
        return empty($res) ? false : $stealLand;
    }

    /**
     * todo::偷取写入内容还没确定
     * 偷取日志功能 可以是偷取日志 也可以是收获日志
     * @param $uid 被偷取的uid
     * @param $stealId 偷取人的uid
     */
    private function stealLog($uid,$stealId)
    {
        $str = time() . mt_rand(1,9999);//生成唯一的key
        $stringKey = 'manorStealLogDetail:' . $uid . ':' . substr(md5($str), 8, 16);
        $value = 'xxx偷了你的菜';
        $this->redis->set($stringKey,$value,60 * 60 * 24 *2); //保留48小时
        $key = 'manorStealLog:' . $uid;
        $this->redis->zAdd($key,time(),$stringKey);
    }
}