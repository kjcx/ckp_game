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
        $arr = Db::table($this->table)->find();
        var_dump($arr);
        $data = Db::table($this->table)->where(['Id'=>1])->find();
        var_dump("======data======");
        var_dump($data);
        return $data ? $data : false;
    }
    /**
     * 获取出售道具价格
     * @param array $items
     * @return array
     */
    public function getSellItemsPrice(array $items)
    {
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
        //1出售道具详细信息
        $data_item = $this->getItemIds([$data['ItemId']]);
        //2出售道具数量
        $data_item[0]['Count'] = $data['Count'];
        $data_price = $this->getSellItemsPrice($data_item);
        return $data_price;
    }
}