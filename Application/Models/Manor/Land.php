<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/17
 * Time: 上午11:34
 */
namespace App\Models\Manor;

use App\Models\BagInfo\Bag;
use App\Models\Model;
use App\Models\User\Role;
use App\Traits\MongoTrait;
use App\Traits\UserTrait;

class Land extends Model
{
    use MongoTrait,UserTrait;

    const SoilNotExploit = 0;//庄园 土地未开发
    const SoilAlreadyExploit = 1;//土地已开发

    public $mongoTable = 'ckzc_data.manor';

    public function __construct($uid)
    {
        parent::__construct();
        $this->setUid($uid);
        $this->collection = $this->getMongoClient();
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
        }
        $landInfo['name'] = $roleInfo['nickname'];
        return $landInfo;
    }
    /**
     * 解锁土地
     */
    public function unlockLand()
    {

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
                'Id' => $id,
                'PlantDate' => 0,
                'SemenId' => 0,//查表
                'StatusTime' => 0,
                'Status' => 0,
                'PhasesStatus' => 0,
                'StealTime' => 0,
                'SoilState' => 0,
//                'UserName' => '傅乐心',
                'SoilLevel' => 1
        ];
        return $landItem;
    }

}