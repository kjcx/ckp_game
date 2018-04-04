<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:07
 */

namespace App\Models;

use App\Utility\Mysql;
use App\Utility\Redis;

class Model
{
    public $mysql;
    public $redis;

    function __construct()
    {
        $this->mysql = Mysql::getInstance()->getConnect();
        $this->redis = Redis::getInstance()->getConnect();
    }

}