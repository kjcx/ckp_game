<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午5:20
 * 广播类型控制器
 */

namespace App\Websocket\Controller;

use EasySwoole\Core\Socket\WebSocketController;

class Broadcast extends WebSocketController
{
    public function index()
    {
//        var_dump($this->client()->getFd());
    }
}