<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/19
 * Time: 下午9:35
 */
namespace App\Models\BagInfo;

use App\Models\Model;
use App\Traits\MongoTrait;
use EasySwoole\Config;
use think\Db;
use think\db\Mongo;

class Init extends Model
{
    use MongoTrait;

    private $mongoTable = 'config_PlayerInit';

    public function __construct()
    {
        parent::__construct();
        $this->getMongoClient();
    }

    /**
     * 获取初始化背包物品
     * @return mixed
     */
    public function getInitData()
    {
        $mongoConf = Config::getInstance()->getConf('MONGO');
        $collection = $this->mongo->ckzc->{$this->mongoTable};
        $data = $collection->findOne(['Id.value' => '1']);
        return $data;
    }
}