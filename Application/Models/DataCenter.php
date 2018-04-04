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

    /**
     *
     * 设置到数据中心 操作
     * @param $fd
     */
    public function saveClient($fd)
    {

        $this->redis->sIsMember();
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


     */
    public function setFdInfo($fd)
    {
        //登录判断
//        $res = $this->redis->sIsMember('',);
    }


}