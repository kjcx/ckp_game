<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/9
 * Time: 下午8:17
 */

namespace App\Models\Execl;


use App\Models\Model;
use think\Db;

class GameConfig extends Model
{
    public $table = 'GameConfig';
    public function getConfig($name)
    {
        $data = Db::table($this->table)->where(['_id'=>$name])->find();
        return $data;
    }
}