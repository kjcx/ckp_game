<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/18
 * Time: 下午2:31
 */

namespace App\Models\Execl;

use App\Models\Model;
use think\Db;
class WsResult extends Model
{
    private $table = 'ckzc.WsResult';
    public function insert($arr)
    {
        //插入数据库
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取错误码
     * @param $msg
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getOne($msg)
    {

        $data = Db::table($this->table)->where(['msg' => $msg])->find();
        return $data;
    }

    /**
     * 获取错误码
     * @param $type
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getErrorValue($type)
    {
        $data = Db::table($this->table)->where(['type' => $type])->find();
        return $data;
    }
}