<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:07
 */

namespace App\Models;

use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use EasySwoole\Core\Component\Di;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;

class Model
{

    public $reidsPool; //带pool的属于连接池
    public $mysqlPool;
    public $mongo;

    public function __construct()
    {
        $this->mysqlPool =
        $this->reidsPool = PoolManager::getInstance()->getPool('App\Utility\RedisPoll');
    }
}