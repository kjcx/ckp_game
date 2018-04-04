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



        $r = $this->mysql->where('id',3)->getOne('ckzc_member');
        var_dump(serialize($r));
        $re = $this->redis->info();
        var_dump(serialize($re));
    }
}