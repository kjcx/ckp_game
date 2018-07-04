<?php
$opensslKey = null;
$opensslMethod = 'DES-EDE3';

//构造服务调用
$data = [
    'serviceName'=>'A',//服务名称
    'serviceGroup'=>'G',//服务组（RPC服务控制器名称）
    'serviceAction'=>'index',//服务行为名（RPC服务控制器action名称）
    'args'=>[
        'a'=>1,
        'b'=>2
    ]
];
$fp = stream_socket_client('tcp://www.ckp520.cn:9502');
//数据打包
$sendStr = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

if($opensslKey){
    $sendStr = openssl_encrypt($sendStr,$opensslMethod,$opensslKey);
}

fwrite($fp,pack('N', strlen($sendStr)).$sendStr);
//需要超时机制的请自己用sock time out
$data = fread($fp,65533);
//做长度头部校验
$len = unpack('N',$data);
$data = substr($data,'4');
if(strlen($data) != $len[1]){
    echo 'data error';
}else{
    if($opensslKey){
        $data = openssl_decrypt($data,$opensslMethod,$opensslKey);
    }
    $json = json_decode($data,true);
    //这就是服务端返回的结果，
    var_dump($json);
}
fclose($fp);

?>