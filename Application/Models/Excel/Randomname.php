<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午3:48
 */

namespace App\Models\Excel;

use App\Models\Model;
use think\Db;

class Randomname extends Model
{
    private $table = 'ckzc.Excel_Randomname';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    public function getOne()
    {
        $data = Db::table($this->table)->find();
        return $data;
    }

    /**
     * 随机获取姓名
     */
    public function getRandSurName()
    {
        $data = $this->getOne();
        var_dump($data);
        if($data){
            $SurName = $data['SurName'];
            mt_srand();
            return $SurName[array_rand($SurName)];
        }else{
            return false;
        }
    }

}