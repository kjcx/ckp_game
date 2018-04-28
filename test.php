<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/27
 * Time: 下午5:54
 */

use Swoole\Coroutine as co;
swoole_timer_tick(3000, function($id) {
   var_dump(1);
    $cli = new swoole_http_client('192.168.31.232', 9501);
    $cli->setHeaders(['User-Agent' => "swoole"]);
    $cli->get('/index/index', function ($cli)
    {
//        var_dump($cli);
    });


//    co::create(function () {
//        $cli = new co\http\client('192.168.31.232', 9501);
//        $cli->setHeaders(['Host' => 'localhost']);
//        $result = $cli->get('/index/index');
//        var_dump($cli->body);
//     assert($result);
//     $ret = json_decode($cli->body, true);
//     assert(is_array($ret) and $ret['json'] == 'true');
//    });



});


