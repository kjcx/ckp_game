<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午3:48
 */

namespace App\Models\Execl;

use App\Models\Model;
use think\Db;

class Drop extends Model
{
    private $table = 'Drop';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取提条记录
     * @param $Id
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->where(['Id'=>$Id])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

}