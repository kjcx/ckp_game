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

class Item extends Model
{
    private $table = 'ckzc.Execl_Item';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取提条记录
     * @param $Id
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->where(['Id'=>$Id])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
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

    /**
     * 按id获取道具
     * @param $id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getItemById($id)
    {
        $data = Db::table($this->table)->where(['Id'=>(int)$id])->find();
        return $data;
    }

    /**
     * @param $id
     */
    public function getItemAttrById($id)
    {
        $item = $this->getItemById($id);

    }
    /**
     * 获取道具使用效果
     * @param $id
     * @param $count
     * @return array
     */
    public function getItemUseEffetById($items)
    {
        $id = $items['ItemId'];
        $Count = $items['Count'];
        $data = $this->getItemById($id);
        var_dump($data);
        $arr = [];
        if(isset($data['UseEffet'])){
            $UseEffet =  $data['UseEffet'];
            $UseEffets = explode(';',$UseEffet);


            foreach ($UseEffets as $item) {
                $items = explode(',',$item);
                if($items[0] == 1){
                    $arr[$items[1]] = $items[2];
                }elseif($items[0] == 3){
                    $arr[$items[1]] = $items[2];
                }
            }
        }
        return $arr;
    }
    /**
     * 获取出售道具价格
     * @param array $items
     * @return array
     */
    public function getSellItemsPrice(array $items)
    {
//        var_dump($items);
        $sum = 0;
        foreach ($items as $item) {
            if(stripos($item['Sell'],',')){
                $cost = explode(',',$item['Sell']);
                $type = $cost[0];//金钱类型
                $Cost = $cost[1];
                $Count = $item['Count'];
                $sum = $Cost * $Count;
                $arr[$type][] = $sum;
            }
        }
        $data = [];
        //计算每个类型的总金额
        foreach ($arr as $k=> $v) {
            $data[$k] = array_sum($v);
        }
        return $data;
    }

    /**
     * 获取出售道具详细信息
     * @param array $data
     * @return array|bool|\PDOStatement|string|\think\Collection
     */
    public function getSellItemInfo(array $data)
    {
//        var_dump($data);
        //1出售道具详细信息
        $data_item = $this->getItemIds([$data['ItemId']]);
        //2出售道具数量
        $data_item[0]['Count'] = $data['Count'];
        $data_price = $this->getSellItemsPrice($data_item);
        return $data_price;
    }

}