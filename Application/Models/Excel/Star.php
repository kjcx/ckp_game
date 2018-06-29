<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/28
 * Time: 下午4:46
 */

namespace App\Models\Excel;

use App\Models\Model;
use think\Db;

class Star extends Model
{
    private $table = 'ckzc.Excel_Star';

    public function getFieldByStarLv($lv)
    {
        return Db::table($this->table)->where(['StarLv'=>(int)$lv])->find();
    }
}