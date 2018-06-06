<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/20
 * Time: 下午3:14
 */

namespace App\Traits;

use EasySwoole\Config;

trait MongoTrait
{
    protected $mongo;
    protected $collection;

    protected function getMongoClient()
    {

        $dbConf = Config::getInstance()->getConf('MONGO');
        if($dbConf['username']){
            $this->mongo = new \MongoDB\Client("mongodb://{$dbConf['username']}:{$dbConf['password']}@{$dbConf['hostname']}:{$dbConf['hostport']}/");
        }else{
            $this->mongo = new \MongoDB\Client("mongodb://{$dbConf['hostname']}/");
        }

        if (isset($this->mongoTable) && strpos($this->mongoTable,'.') !== false) {
            return $this->mongo->selectDatabase(explode('.',$this->mongoTable)['0'])
                                            ->selectCollection(explode('.',$this->mongoTable)['1']);
        }
        return $this;
    }
}