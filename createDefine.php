<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/12
 * Time: 下午7:54
 */

$arr = require 'Application/Conf/msgDefine.php';
$fileName = 'msgdefine';
unlink($fileName);
foreach ($arr as $k => $v) {
    file_put_contents($fileName,"{$v['message']},{$v['message']}.proto,{$v['type']},{$v['msgid']},{$v['desc']}" . "\n",FILE_APPEND);
}
echo 'ok';