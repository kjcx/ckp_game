<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:32
 */
namespace App\Models\LoadData;
use Think\Db;
/**
 * Class LoadDropData
 * @package App\Models\LoadData
 */
class LoadDropData
{
    private $table = 'ckzc.item';

    /**
     * getShopType 道具类型
     * @param $shopType
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getShopType($shopType)
    {
        $data = Db::table($this->table)->where(['Type'=>$shopType])->select();
        return $data;
    }
}