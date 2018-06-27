<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/27
 * Time: 下午1:27
 */

$redis = new Redis();
$redis->connect('127.0.0.1','6379');
$arr = $redis->get('room:_id:5b32f45d9a8920411603b615');
$arr = unserialize($arr);
$configsPosition = array_column($arr['config'],'position'); //配置位置信息
$configsItem = array_column($arr['config'],'item'); //配置家具信息

echo '<pre>';
print_r(array_combine($configsPosition,$configsItem));
exit;