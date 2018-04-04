<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:04
 * 数据中心模型
 */
namespace App\Models;

use EasySwoole\Core\Swoole\Coroutine\PoolManager;

class DataCenter extends Model
{


    public function __construct()
    {
        parent::__construct();

    }

    public function saveClient()
    {

        $mysql = $this->mysqlPool;
        var_dump($mysql->getObj()->get('ckzc_member',10));
        $redis = $this->reidsPool;
        var_dump($redis->getObj()->exec("get","token"));
        $redis->getObj()->exec("set","aaa","111");
        var_dump($redis->getObj()->exec("get","aaa"));

    }
}