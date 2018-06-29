<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/27
 * Time: 下午1:27
 */
use MongoDB\BSON\ObjectId;
$t1 = microtime(true);
$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$redis->select(3);
$Id = 2;
for ($i = 1; $i < 1000; $i++) {
    $redis->hSet('bag:36',$i,serialize(['Count'=>10000000,'Id'=>$i]));

}
//for ($i = 0; $i < 200000; $i++) {
//    $mId = (string)(new ObjectId());
//    $key = 'test:_id:' . $mId;
//    $value = createData($mId);
//    $redis->set($key,json_encode($value));
//    //写队列
//    $task = 'test|string|set|' . $key;
//    $redis->lPush('DataList',$task);
//    echo "入队成功 \n";
//}
//
//
//$t2 = microtime(true);
//echo '耗时'.round($t2-$t1,3).'秒';
//function createData($mId)
//{
//    $data = [
//        '_id' => $mId,
//        'key' => 123
//    ];
//    return $data;
//}