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

    public function insert($data)
    {
        Db::table($this->table)->insert($data);
    }

    /**
     * 通过Field 获取配置信息
     * @param $Field
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoByField($Field)
    {
        $data = Db::table($this->table)->where(['Field'=>$Field])->find();
        return $data;
    }
}