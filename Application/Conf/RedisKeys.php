<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * Time: 下午8:04
 * 关于redis 所有的key信息
 */

return [
    'a' => 'dupeng',
    'gloable' => [ //全局信息频道
         'test' => ['test',function ($msg) {App\Event\RedisEventHelper::test($msg);}],
    ],
    'data_center' => 'datacenter'    //数据中心key
];