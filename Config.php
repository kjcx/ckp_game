<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/12/30
 * Time: 下午10:59
 */
$APP_SERVER_URL = 'http://www.ckp520.com';
return [
    'MAIN_SERVER'=>[
        'HOST'=>'0.0.0.0',
        'PORT'=>9501,
        'SERVER_TYPE'=>\EasySwoole\Core\Swoole\ServerManager::TYPE_WEB_SOCKET_SERVER,
        'SOCK_TYPE'=>SWOOLE_TCP,//该配置项当为SERVER_TYPE值为TYPE_SERVER时有效
        'RUN_MODEL'=>SWOOLE_PROCESS,
        'SETTING'=>[
            'task_worker_num' => 8, //异步任务进程
            'task_max_request'=>10,
            'max_request'=>5000,//强烈建议设置此配置项
            'worker_num'=>8
        ],
    ],
    'DEBUG'=>true,
    'TEMP_DIR'=>EASYSWOOLE_ROOT.'/Temp',
    'LOG_DIR'=>EASYSWOOLE_ROOT.'/Log',
    'EASY_CACHE'=>[
        'PROCESS_NUM'=>1,//若不希望开启，则设置为0
        'PERSISTENT_TIME'=>0//如果需要定时数据落地，请设置对应的时间周期，单位为秒
    ],
    'CLUSTER'=>[
        'enable'=>false,
        'token'=>null,
        'broadcastAddress'=>['255.255.255.255:9556'],
        'listenAddress'=>'0.0.0.0',
        'listenPort'=>9556,
        'broadcastTTL'=>5,
        'serviceTTL'=>10,
        'serverName'=>'easySwoole',
        'serverId'=>null
    ],
    'MYSQL_SERVER' =>[
        'host' => '139.129.119.229',
//        'host' => '192.168.31.232',
        'username' => 'root',
//        'username' => 'homestead',
//        'password' => 'secret',
        'password' => 'mmDongkaikjcx13579',
//        'password' => '123456',
        'dbname'=> 'ckzc',
        'port' => 3306,
        'charset' => 'utf8',
        'pool' => [
            'max' => 10,//最大连接数 没用了
            'min' => 5, //最小连接数
        ]
    ],
    'REDIS_SERVER' => [
        'host' => '127.0.0.1', // redis主机地址
        'port' => 6379, // 端口
        'serialize' => false, // 是否序列化php变量
        'auth' => null, // 密码
        'pool' => [
            'min' => 5, // 最小连接数
            'max' => 10 // 最大连接数
        ],
        'dbname' => 1
//        'errorHandler' => function(){
//            return null;
//        } // 如果Redis重连失败，会判断errorHandler是否callable，如果是，则会调用，否则会抛出异常，请自行try
    ],
    'MONGO'=>[
// 数据库类型
        'type'            => 'mongo',
        // 服务器地址
        'hostname'        => '139.129.119.229',
        // 数据库名
        'database'        => 'ckzc',
        // 用户名
        'username'        => '',
        // 密码
        'password'        => '',
        // 端口
        'hostport'        => '',
        // 连接dsn
        'dsn'             => '',
        // 数据库连接参数
        'params'          => [],
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => '',
        // 数据库调试模式
        'debug'           => false,
        // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy'          => 0,
        // 数据库读写是否分离 主从式有效
        'rw_separate'     => false,
        // 读写分离后 主服务器数量
        'master_num'      => 1,
        // 指定从服务器序号
        'slave_no'        => '',
        // 是否严格检查字段是否存在
        'fields_strict'   => true,
        // 数据集返回类型
        'resultset_type'  => '',
        // 自动写入时间戳字段
        'auto_timestamp'  => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => 'Y-m-d H:i:s',
        // 是否需要进行SQL性能分析
        'sql_explain'     => false,
        // Builder类
        'builder'         => '',
        // Query类
        'query'           => '\\think\\db\\Query',
        // 是否需要断线重连
        'break_reconnect' => false,
    ],
    'SERVER_CONF' => [
        'server_address' => '192.168.10.10:9501', //当前机器的地址
        'server_hash' => '1' //当前机器hash
    ],

    'APP'=> [
        'member_info' => $APP_SERVER_URL . '/mobile/index.php?act=member_index',
        'pay_app'=> $APP_SERVER_URL . '/mobile/index.php?act=member_fund&op=balance_edit',
        ]

];