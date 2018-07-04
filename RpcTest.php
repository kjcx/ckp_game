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
        'address'=>'192.168.31.119',
        'port'=>9999
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