<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/28
 * Time: 下午2:18
 */

require 'vendor/autoload.php';

\EasySwoole\Core\Core::getInstance()->initialize();
//注册服务，让RPC服务管理中心知道当前系统中存在哪些服务

$ServiceManager = \EasySwoole\Core\Component\Rpc\Server::getInstance();
$ServiceManager->updateServiceNode(new \EasySwoole\Core\Component\Rpc\Common\ServiceNode(
    [
        'serviceName'=>'A',
<<<<<<< HEAD
<<<<<<< HEAD
        'port'=>9502
=======
        'address'=>'192.168.31.119',
        'port'=>9999
>>>>>>> a13c1afd374c9ee45e9a008bc981383be5b538b3
=======
        'port'=>9502,
        'encryptToken'=>'123',
        'address'=>'192.168.31.232'
>>>>>>> 9457fa0f1d3757ea18c9a0c7cd596bab8f1b1a24
    ]
));
//
//$ServiceManager->updateServiceNode(new \EasySwoole\Core\Component\Rpc\Common\ServiceNode(
//    [
//        'serviceName'=>'B',
//        'port'=>9503,
//        'encryptToken'=>'password123'
//    ]
//));


//创建RPC客户端
$client = new \EasySwoole\Core\Component\Rpc\Client();

//调用A服务中G服务组的index行为
$client->addCall('A','G','index')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('11fail',$response);
})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('11success',$response);
});


//执行调用
$client->call();
