<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午11:14
 */

namespace App\Models\Excel;

use App\Models\Model;
use think\Db;

class Fram extends Model
{
    private $table = 'ckzc.Excel_Fram';

    /**
     * 获取提条记录
     * @param $Id
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->where(['Id'=>(int)$Id])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
}