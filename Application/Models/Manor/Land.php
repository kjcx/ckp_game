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
use App\Traits\MongoTrait;
use App\Traits\UserTrait;

class Land extends Model
{
    use MongoTrait,UserTrait;

    public $mongoTable = 'ckzc_data.land';

    public function __construct($uid)
    {
        parent::__construct();
        $this->setUid($uid);
        $this->collection = $this->getMongoClient();
    }

    /**
     * 初始化地块
     */
    public function initLand()
    {
        $uid = $this->getUid();
        $landInfo = $this->collection->findOne(['uid' => $uid]);
        if ($landInfo) {
            //当前有地块信息
            return false;
        }
        $landData = [];
        for ($i = 0; $i < 4; $i++) {
            $landItem = $this->createLandItem();
            $landItem['locking'] = false;
            $landData[] = $landItem;
        }
        $this->collection->insertOne($landData);

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
     * 获取地块信息
     */
    private function getLand()
    {
        $landData = $this->collection->findOne(['uid' => $this->getUid()]);
        return $landData;
    }
    /**
     *创建一个地块的数据
     */
    private function createLandItem()
    {
        $landItem = [
            'locking' => true,//锁定  默认锁定
            'level' => 1,//地块等级
            'create_at' => time(),
            'update_at' => '',
            'crop' => [],
            'icon' => '',
            'log' => [] //土地操作日志
        ];
        return $landItem;
    }

}