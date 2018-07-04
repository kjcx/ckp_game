<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/27
 * Time: 下午1:27
 */
$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$redis->select(1);
$value = ['uid' => 115,'fd' => 25 ,'serverHash' => 1];
$redis->hSet('datacenter','115',json_encode($value));



var_dump(new \MongoDB\BSON\ObjectId());