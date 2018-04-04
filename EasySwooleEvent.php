<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Utility\Mysql;
use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use App\Websocket\Parser\WebSock;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use EasySwoole\Core\Swoole\EventHelper;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use EasySwoole\Core\Component\Di;
use App\Event\MainEventHelper;

Class EasySwooleEvent implements EventInterface {

    public function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public function mainServerCreate(ServerManager $server,EventRegister $register): void
    {

        // TODO: Implement mainServerCreate() method.
        $register->add($register::onWorkerStart,function (\swoole_server $server,$workerId){

            //为workerId为0的进程添加定时器
            //请确定有inotify拓展
            if ($workerId == 0) {
                if (Config::getInstance()->getConf('DEBUG')) {
                    MainEventHelper::registerHotLoad();
                }
            }
        });

        EventHelper::registerDefaultOnMessage($register,new WebSock());



    }

    public function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}