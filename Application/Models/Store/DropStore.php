<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/21
 * Time: 下午3:10
 * 掉落库数据mongo直接读取比较慢 框架初始化的时候加载到redis中
 */

namespace App\Models\Store;

use App\Models\Model;
use App\Traits\MongoTrait;
use EasySwoole\Config;
use EasySwoole\Core\Component\Di;

class DropStore extends Model
{
    use MongoTrait;

    private $uid;

    private $mongoTable = 'ckzc.dropShop';
    private $redisKey;
    private $dropShopData;

    public function __construct(Int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
        $this->collection = $this->getMongoClient();
        $this->init();
    }

    /**
     * 初始化个人掉落库
     */
    private function init()
    {
        $this->dropShopData = $this->mongo->ckzc->dropShop->find()->toArray();

    }





    /**
     *
     */
    public function randGoods($dropLib)
    {
        $randArr = [];
        foreach ($dropLib as $k => $v) {
            $v['weight']
        }
    }
    /**
     * 缓存掉落库
     */
    public function cacheDropShop()
    {
        
    }
    /**
     *
     */
    public function refreshDropShop()
    {
        return $this->dropShopData;
    }




}