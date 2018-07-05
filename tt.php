<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/27
 * Time: 下午1:27
 */
$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$task = '';
$keys = $redis->keys('bagList:uid:*');

foreach ($keys as $key) {
    $task = "bagList|hash|set|{$key}|1";
    $redis->lPush('DataList',$task);
}

echo 'ok';