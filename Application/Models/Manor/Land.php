<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/17
 * Time: 上午11:34
 */
namespace App\Models\Manor;

use App\Models\BagInfo\Bag;
use App\Models\Execl\GameConfig;
use App\Models\Item\Item;
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

    public $mongoTable = 'ckzc_data.manor';
    private $item;

    public function __construct($uid)
    {
        parent::__construct();
        $this->setUid($uid);
        $this->setRoleInfo();
        $this->collection = $this->getMongoClient();
        $this->item = new Item();
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
        $landInfo = $this->collection->findOne(['uid' => $uid]);
        foreach ($landInfo['manor'] as $key => $value) {
            $landInfo['manor'][$key]['UserName'] = $roleInfo['nickname'];
            if ($value['SemenId'] > 0) {
                //种植了作物  计算作物的时间
                $landInfo['manor'][$key]['PhasesStatus'] = $this->calcCrop($value);
            }
        }
        $landInfo['name'] = $roleInfo['nickname'];
        return $landInfo;
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
            //更新身价值

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
                'manor.' . ($landId - 1) . '.SoilState' => self::SoilAlreadyExploit
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
        $this->getLand();
        $bag->delBag(2,1);
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
                'Profit' => 0 //收益加层
        ];
        return $landItem;
    }

}