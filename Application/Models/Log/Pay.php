<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/9
 * Time: 下午1:52
 */

namespace App\Models\Log;


use App\Models\Model;
use think\Db;

class Pay extends Model
{
    public $table = 'PayGlogLog';

    /**
     * 插入金币充值日志
     * @param $data
     */
    public function create($data)
    {
        Db::table($this->table)->insert($data);
    }

    /**
     * 更改充值状态
     * @param $lg_source_only
     * @param $update
     */
    public function changeOrderStatus($lg_source_only,$update)
    {
        Db::table($this->table)->where(['lg_source_only'=>$lg_source_only])->update($update);
    }

    /**
     * 获取是否是第一次充值
     * @param $Uid
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getFirstRecharge($Uid)
    {
        $rs = Db::table($this->table)->where('Uid',$Uid)->find();
        return $rs;
    }
}