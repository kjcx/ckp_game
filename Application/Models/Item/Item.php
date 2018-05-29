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
    private $table = 'ckzc.item';

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
        $data = Db::table($this->table)->where(['Id'=>$id])->find();
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
        $UseEffet =  $data['UseEffet'];
        $UseEffets = explode(';',$UseEffet);
        $arr = [];
        var_dump($UseEffets);

        foreach ($UseEffets as $item) {
            $items = explode(',',$item);
            $arr[]  = [
                'Id'=>$items[1],'CurCount'=>$items[2]
            ];

        }
        var_dump($arr);
        return $arr;
    }
    /**
     * 获取出售道具价格
     * @param array $items
     * @return array
     */
    public function getSellItemsPrice(array $items)
    {
        var_dump($items);
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
        var_dump($data);
        //1出售道具详细信息
        $data_item = $this->getItemIds([$data['ItemId']]);
        //2出售道具数量
        $data_item[0]['Count'] = $data['Count'];
        $data_price = $this->getSellItemsPrice($data_item);
        return $data_price;
    }
}