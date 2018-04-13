<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;
use App\Event\BookEvent;
use App\Event\BookSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;

use App\Event\RedisEventHelper;
use App\Process\Subscribe;
use App\Utility\Mysql;
use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use App\Websocket\Parser\WebSock;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use EasySwoole\Core\Swoole\EventHelper;
use EasySwoole\Core\Swoole\Process\ProcessManager;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use EasySwoole\Core\Component\Di;
use App\Event\MainEventHelper;
use EasySwoole\Core\Utility\File;
use App\Event\RedisEvent;
use think\Db;

Class EasySwooleEvent implements EventInterface {

    public function frameInitialize(): void
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');
        ini_set('default_socket_timeout', -1);
        $this->loadConf(EASYSWOOLE_ROOT . '/Application/Conf');


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

        ProcessManager::getInstance()->addProcess('redis_sub',Subscribe::class); //添加redis订阅进程
        EventHelper::registerDefaultOnMessage($register,new WebSock());



    }

    /**
     * 加载配置文件
     * @param $ConfPath
     */
    public function loadConf($ConfPath)
    {
        $Conf  = Config::getInstance();
        $files = File::scanDir($ConfPath);
        foreach ($files as $file) {
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array)$data);
        }
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