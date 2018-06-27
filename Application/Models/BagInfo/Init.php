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

    private $mongoTable = 'ckzc.Excel_PlayerInit';

    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->getMongoClient(); //并非所有的类都要进行这样的操作
    }

    /**
     * 获取初始化背包物品
     * @return mixed
     */
    public function getInitData()
    {
        $mongoConf = Config::getInstance()->getConf('MONGO');
        $data = $this->collection->findOne(['Id.value' => '1']);
        return $data;
    }
}