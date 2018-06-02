<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午10:13
 */

namespace App\Helpers;


use EasySwoole\Core\Socket\AbstractInterface\ExceptionHandler;

class ErrorHandle implements ExceptionHandler
{
    public static function handler(\Throwable $throwable, string $data, $client): ?string
    {
        // TODO: Implement handler() method.
        return '捕获成功';
    }
}