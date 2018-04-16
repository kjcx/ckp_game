<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/14
 * Time: 下午5:18
 */

namespace App\Models\Item;


use App\Models\Model;
use think\Db;

class Item extends Model
{
    private $table = 'item';

    /**
     * 根据id获取数据
     * @param array $ids
     * @return array|bool|\PDOStatement|string|\think\Collection
     */
    public function getItemIds(array $ids)
    {
        $data = Db::table($this->table)->where('Id','in',$ids)->select();
        return $data ? $data : false;
    }
}