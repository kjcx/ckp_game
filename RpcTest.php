<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/28
 * Time: 下午2:18
 */

require 'vendor/autoload.php';

\EasySwoole\Core\Core::getInstance()->initialize();

$ServiceManager = \EasySwoole\Core\Component\Rpc\Server\ServiceManager::getInstance();
$ServiceManager->addServiceNode(new \EasySwoole\Core\Component\Rpc\Server\ServiceNode(
    [
        'serviceName'=>'A',
        'port'=>9505
    ]
));

$ServiceManager->addServiceNode(new \EasySwoole\Core\Component\Rpc\Server\ServiceNode(
    [
        'serviceName'=>'B',
        'port'=>9506,
        'encryptToken'=>'password1123'
    ]
));
//创建RPC客户端
$client = new \EasySwoole\Core\Component\Rpc\Client();

//调用A服务中G服务组的index行为
$client->addCall('A','g','index')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('11fail',$response);
})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('11success',$response);
});

//调用A服务中G服务组的c行为
//$client->addCall('A','g','c')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('22fail',$response);
//})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('22success',$response);
//});
//调用A服务中c服务组的c行为
//$client->addCall('A','c','c')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('33fail',$response);
//})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('33success',$response);
//});
//调用c服务中c服务组的c行为
//$client->addCall('c','c','c')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('44fail',$response);
//})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
//    var_dump('44success',$response);
//});

//调用B服务中c服务组的index行为
$client->addCall('B','index','index')->setFailCall(function(\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('55fail',$response);
})->setSuccessCall(function (\EasySwoole\Core\Component\Rpc\Client\ServiceResponse $response){
    var_dump('55success',$response);
});

//执行调用
$client->call();