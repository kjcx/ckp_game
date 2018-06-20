<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:07
 */

namespace App\Models;

use App\Utility\Mysql;
use App\Utility\Redis;
use EasySwoole\Config;
use think\Db;

class Model
{
    public $mysql;
    public $redis;
    public function __construct()
    {
        $this->mysql = Mysql::getInstance()->getConnect();
        $this->redis = Redis::getInstance()->getConnect();
        $dbConf =  $dbConf = Config::getInstance()->getConf('REDIS_SERVER');
        $this->redis->select($dbConf['dbname']);
        $dbConf =  $dbConf = Config::getInstance()->getConf('MONGO');
        // 全局初始化
        Db::setConfig($dbConf);

    }




}