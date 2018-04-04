<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午7:00
 */

namespace App\Utility;

use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;

class Redis
{
    use Singleton;

    private $connect;

    public function __construct()
    {
        $this->connect = new \Redis();
        $this->connect();
    }

    public function getConnect()
    {
        return $this->connect;
    }

    public function exec($func,$args)
    {
        if(!$this->connect->ping()){
            $this->connect();
        }
        try{
            return $this->connect->$func($args);
        }catch (\Throwable $throwable){
            Trigger::throwable($throwable);
            return null;
        }

    }

    private function connect()
    {
        $conf = Config::getInstance()->getConf("REDIS_SERVER");
        $this->connect->connect($conf['host'],$conf['port']);
        if (!empty($conf['password'])) {
            $this->connect->auth($conf['password']);
        }
    }
}