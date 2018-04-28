<?php

$serv = new swoole_server("127.0.0.1", 9502,SWOOLE_BASE);
$serv->set(array(
    'worker_num' => 20,
    'task_worker_num' => 10,
//    'task_ipc_mode' => 3,
//    'message_queue_key' => 0x70001001,
    //'task_tmpdir' => '/data/task/',
));
$serv->on('Receive', function(swoole_server $serv, $fd, $from_id, $data) {


});
$serv->on('Task', function (swoole_server $serv, $task_id, $from_id, $data) {

    echo "#{$serv->worker_id}\tonTask: [PID={$serv->worker_pid}]: task_id=$task_id, data_len=".strlen($data).".".PHP_EOL;
    $serv->finish($data);
//    return $data;
});
$serv->on('Finish', function (swoole_server $serv, $task_id, $data) {
    echo "Task#$task_id finished, data_len=".strlen($data).PHP_EOL;
});
$serv->on('workerStart', function($serv, $worker_id) {
    if(!$serv->taskworker){
        $serv->tick(3000,function() use ($serv){
            $cli = new swoole_http_client('192.168.31.232', 9501);
            $cli->setHeaders(['User-Agent' => "swoole"]);
            $cli->get('/index/index', function ($cli)
            {
        var_dump(1);
            });
        });
    }
});
$serv->start();