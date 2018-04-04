<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:57
 */

namespace App\Utility;

use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;

class Mysql
{
    use Singleton;

    private $db;

    public function __construct()
    {
        $conf = Config::getInstance()->getConf('MYSQL_SERVER');
//        var_dump($conf);
        $this->db =  new \MysqliDb($conf['host'],$conf['username'],$conf['password'],$conf['dbname']);
    }

    public function getConnect():\MysqliDb
    {

        return $this->db;
    }
}