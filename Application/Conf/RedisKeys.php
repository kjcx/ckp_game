<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * Time: 下午8:04
 * 关于redis 所有的key信息
 */

return [
    'example' => [//例子key   实际使用方式在代码中 只是提供例子
        '1:uid:fd'    //1为机器hash或者编号 uid用户uid fd 用户接入机器的fd 数据中心有使用例子

    ],
    'a' => 'dupeng',
    'gloable' => [ //全局信息频道
         'test' => ['test',function ($msg) {App\Event\RedisEventHelper::test($msg);}],
    ],
    'data_center' => 'datacenter'    //数据中心key
];