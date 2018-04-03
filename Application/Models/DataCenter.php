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
        $redis = PoolManager::getInstance()->getPool('App\Utility\RedisPool');
        var_dump($redis->getObj());
    }
}