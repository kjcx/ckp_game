<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午7:09
 */

namespace App\Models\Sales;


use App\Models\Model;
use think\Db;

class SalesItem extends Model
{
    public $table = 'ckzc.SalesItem';
    /**
     * 创建记录
     */
    public function create($data)
    {
        $data = Db::table($this->table)->insert($data);
        if($data){
            return Db::table($this->table)->getLastInsID();
        }else{
            return false;
        }
    }

    /**
     * 获取一条记录
     * @param $Id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->find($Id);
        return $data;
    }

    /**
     * @param $Uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAll($Uid)
    {
        $data = Db::table($this->table)->where('Uid','<>',$Uid)->where('Count','>',0)->select();
        return $data;
    }

    /**
     * 获取所有
     * @param $Uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAllByUid($Uid)
    {
        $data = Db::table($this->table)->where('Uid',$Uid)->where('Count','>',0)->select();
        return $data;
    }

    /**
     * 下架商品
     * @param $Id
     * @return int
     */
    public function SoldOutById($Id)
    {
        $rs = Db::table($this->table)->where('_id',$Id)->delete();
        return $rs;
    }

    /**
     * 减少商品数量
     * @param $Id
     * @param $num
     * @return int|true
     */
    public function ReduceSalesItem($Id,$num)
    {
        $data = $this->getInfoById($Id);
        if($data['Count'] > $num){
            $rs = Db::table($this->table)->where('_id',$Id)->setDec('Count',$num);
            return $rs;
        }elseif ($data['Count'] == $num){
            //删除商品
            $rs = $this->SoldOutById($Id);
            return $rs;
        }else{
            var_dump("减少商品数量失败");
            return false;
        }
    }
}