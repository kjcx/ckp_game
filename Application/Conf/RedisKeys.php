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
        'resetDrop:uid',//掉落库重置资格key
        '1:uid:fd',    //1为机器hash或者编号 uid用户uid fd 用户接入机器的fd 数据中心有使用例子
        'dropShop:10',  //掉落库redis key 对应的mongo 表是 dropShop dropShop:10   表示 dropShop:id = 1  第二个表示id
        'drop:uid:Id', //掉落率的redis key   每个人的 单个key的过期时间为 180min 规则 drop: + uid:+ 商店Id
        'FruitsData:uid',//水果机数据
        'FruitsDataWeight:uid',//水果机权重数据
        'FriendInfo:uid',//好友数据
        'manorStealLog:uid',//庄园偷取日志 有序集合
        'manorStealLogDetail:uid:$id', //庄园偷取单个日志 $id为一个算法Id
        'roomList:uid:',//住宅集合  是一个zset
        'room:_id:mongodid',//住宅单个key string型

    ],
    'a' => 'dupeng',
    'gloable' => [ //全局信息频道
         'test' => ['test',function ($msg) {App\Event\RedisEventHelper::test($msg);}],
    ],
    'data_center' => 'datacenter'    //数据中心key
];