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

    /**
     * 获取所有 当前机器的fd信息
     */
    public function getMyFd()
    {
        //机器号 1下面的所有连接信息
        $fds = $this->redis->keys('1:*');

        array_walk($fds,function(&$fd,$key){
            $fds[$key] = unserialize($fd);
        });

        return $fds;
    }
}