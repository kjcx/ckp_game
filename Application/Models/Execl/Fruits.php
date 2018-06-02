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

class Fruits extends Model
{
    private $table = 'ckzc.Execl_Fruits';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取所有水果机配置
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAll()
    {
        $data = Db::table($this->table)->select();
        return $data;
    }
}