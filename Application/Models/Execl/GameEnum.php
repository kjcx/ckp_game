<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/12
 * Time: 下午2:20
 */
namespace App\Models\Execl;
use App\Models\Model;
use think\Db;
class GameEnum extends Model
{
    private $table = 'GameEnum_1';
    public function insert($arr)
    {
        //插入数据库
        Db::table($this->table)->insert($arr);
    }

    public function find($where)
    {
        $data = Db::table($this->table)->where($where)->find();
        return $data;
    }
}