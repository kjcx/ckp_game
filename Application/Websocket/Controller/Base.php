<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午5:54
 * websocket 基类控制器
 * websocket 基类控制器
 */

namespace  App\Websocket\Controller;
use EasySwoole\Config;
use EasySwoole\Core\Socket\WebSocketController;

class Base extends WebSocketController
{

    public $serverId;
    /**
     * 初始化方法
     * 登录验证
     * 中心服务器取当前用户信息
     * Base constructor.
     */
    public function __construct()
    {
        $this->serverId = Config::getInstance()->getConf('SERVER_FONF.server_hash');

    }
}