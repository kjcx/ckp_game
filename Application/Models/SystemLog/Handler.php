<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午9:13
 */

namespace App\Models\SystemLog;

use EasySwoole\Core\AbstractInterface\LoggerWriterInterface;

class Handler implements LoggerWriterInterface
{
    function writeLog($obj, $logCategory, $timeStamp)
    {
        // TODO: Implement writeLog() method.
    }
}