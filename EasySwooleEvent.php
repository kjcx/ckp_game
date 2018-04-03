<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Websocket\Parser\WebSock;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use EasySwoole\Core\Swoole\EventHelper;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;
use EasySwoole\Core\Component\Di;
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
            var_dump($workerId);
            //为workerId为0的进程添加定时器
            //请确定有inotify拓展
            if ($workerId == 0) {
                // 递归获取所有目录和文件
                $a = function ($dir) use (&$a) {
                    $data = array();
                    if (is_dir($dir)) {
                        //是目录的话，先增当前目录进去
                        $data[] = $dir;
                        $files = array_diff(scandir($dir), array('.', '..'));
                        foreach ($files as $file) {
                            $data = array_merge($data, $a($dir . "/" . $file));
                        }
                    } else {
                        $data[] = $dir;
                    }
                    return $data;
                };
                $list = $a("./Application");
//                var_dump($list);
                $notify = inotify_init();
                var_dump($notify);

                // 为所有目录和文件添加inotify监视
                foreach ($list as $item) {
                    inotify_add_watch($notify, $item, IN_CREATE | IN_DELETE | IN_MODIFY);
                }
                // 加入EventLoop
                swoole_event_add($notify, function () use ($notify) {
                    var_dump($notify);
                    $events = inotify_read($notify);
                    if (!empty($events)) {
                        //注意更新多个文件的间隔时间处理,防止一次更新了10个文件，重启了10次，懒得做了，反正原理在这里
                        ServerManager::getInstance()->getServer()->reload();
                    }
                });
            }
        });

        Di::getInstance()->set('MYSQL',\MysqliDb::class,Array (
                'host' => '139.129.119.229',
                'username' => 'root',
                'password' => 'mmDongkaikjcx13579',
                'db'=> 'ckzc',
                'port' => 3306,
                'charset' => 'utf8')
        );
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