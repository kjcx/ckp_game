<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/22
 * Time: 上午10:35
 */

namespace App\Models\Execl;


use think\Db;

class Room
{
    private $table = 'ckzc.Excel_Room';

    /**
     * @param $key
     * @return array|bool|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getRoomByKey($key)
    {
        $data = Db::table($this->table)->where(['Key'=>(int)$key])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
}