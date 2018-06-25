<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午2:05
 */

namespace App\Models\Excel;
use App\Models\Model;
use think\Db;

/**
 * 充值金额列表
 * Class Topup
 * @package App\Models\Excel
 */
class Topup extends Model
{
    public $table = 'ckzc.Topup';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取一条数据
     * @param $id
     */
    public function findById($id)
    {
        $data = Db::table($this->table)->where(['Id'=>$id])->find();
        return $data;
    }
}