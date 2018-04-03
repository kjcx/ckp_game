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

class DataCenter
{

    public function __construct()
    {
        parent::__construct();
    }
    public function saveClient()
    {


        $mysql = $this->mysqlPool;
        var_dump($mysql->getObj(0.1));
        $redis = $this->reidsPool;
        var_dump($redis);
    }
}