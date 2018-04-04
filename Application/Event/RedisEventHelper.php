<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * Time: 下午8:54
 */

namespace App\Event;

class RedisEventHelper
{
    public static function test($msg)
    {
        echo "\e[32m" . str_pad($msg, 20, ' ', STR_PAD_RIGHT) . "\e[34m" . $msg . "\e[0m\n";
    }
}