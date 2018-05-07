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
    private $table = 'WsResult';
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
        $data = Db::table($this->table)->where(['msg'=>$msg])->find();
        return $data;
    }
}