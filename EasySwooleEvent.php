<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Event\RedisEventHelper;
use App\Process\Subscribe;
use App\Process\WebScokExist;
use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use App\Websocket\Parser\WebSock;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Swoole\EventHelper;
use EasySwoole\Core\Swoole\Process\ProcessManager;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use App\Event\MainEventHelper;
use EasySwoole\Core\Utility\File;
use App\Event\RedisEvent;
use \EasySwoole\Core\Component\Rpc\Server as RpcServer;
Class EasySwooleEvent implements EventInterface {

    public static function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
        ini_set('default_socket_timeout', -1);
        self::loadConf(EASYSWOOLE_ROOT . '/Application/Conf');
        
    }

    public static function mainServerCreate(ServerManager $server,EventRegister $register): void
    {

        // TODO: Implement mainServerCreate() method.
        $register->add($register::onWorkerStart,function (\swoole_server $server,$workerId){

            //为workerId为0的进程添加定时器
            //请确定有inotify拓展
            if ($workerId == 0) {

//                if (Config::getInstance()->getConf('DEBUG')) {
//                    MainEventHelper::registerHotLoad();
//                }
                $start_fd = 0;
                while(true)
                {
                    $conn_list = $server->getClientList($start_fd, 100);
//                    var_dump('当前连接数');
//                    if(is_array($conn_list)){
//                        var_dump(count($conn_list));
//                    }

                    if ($conn_list===false or count($conn_list) === 0)
                    {
//                        echo "finish\n";
                        break;
                    }
                    $start_fd = end($conn_list);
                    foreach($conn_list as $fd)
                    {
                        $info =  $server->getClientInfo($fd);
                        if($server->exist($fd)){
//                            var_dump("=========存在" .$fd);
                        }else{
//                           $server->close($fd);
                        }

                    }
                }
            }
        });

        ProcessManager::getInstance()->addProcess('redis_sub',Subscribe::class); //添加redis订阅进程

        ProcessManager::getInstance()->addProcess('socket_exist',Subscribe::class); //websocket 心跳检测

        EventHelper::registerDefaultOnMessage($register, WebSock::class,RedisEventHelper::test(23),RedisEventHelper::test(12));

//        EventHelper::registerDefaultOnMessage($register,WebSock::class);


        $register->add($register::onClose, function ($ser,$fd) {//离线删除连接
            RedisEventHelper::remove($fd);
        });
        $register->add($register::onConnect, function ($ser,$fd) {//离线删除连接
            var_dump('fd'.'-'.$fd);
        });

//        RpcServer::getInstance()->addService('A',9505)
//            ->addService('B',9506,'password123')
//            ->attach();


    }

    /**
     * 加载配置文件
     * @param $ConfPath
     */
    public static function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDir($ConfPath);
        foreach ($files as $file) {
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array)$data);
        }
    }
    public static function onRequest(Request $request,Response $response): void
    {
        // TODO: Implement onRequest() method.
    }

    public static function afterAction(Request $request,Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}