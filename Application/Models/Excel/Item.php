<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午3:48
 */

namespace App\Models\Excel;

use App\Models\Model;
use App\Utility\Cache;
use think\Db;

class Item extends Model
{
    private $table = 'ckzc.Excel_Item';
    private $cache;
    private $key = 'config:item:';

    public function __construct()
    {
        $this->cache = Cache::getInstance();
    }
    public function getOne()
    {
        return Db::table($this->table)->find();
    }
    /**
     * 获取提条记录
     * @param $Id
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $key = $this->key . $Id;
        $data = $this->cache->stringGet($key);
        if (!$data) {
            $data = Db::table($this->table)->where(['Id'=>(int)$Id])->find();
            $data = $this->objectToArray($data);
            $this->cache->stringSet($key,$data);
        } else {
            return $data;
        }
    }
    /**
     * 根据id获取数据
     * @param array $ids
     * @return array|bool|\PDOStatement|string|\think\Collection
     */
    public function getItemIds(array $ids)
    {
        $data = [];
        foreach ($ids as $id) {
            $data[] = $this->getInfoById($id);
        }

        return $data ? $data : false;
    }

    /**
     * 按id获取道具
     * @param $id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getItemById($id)
    {
        $data = $this->getInfoById($id);
        return $data;
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
        var_dump($id);
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
                }elseif ($items[0] == 6){
                    $data_drop = $this->getItemByDropId($items[1]);
//                    var_dump($data_drop);
                    return $data_drop;
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
    /**
     * 通过掉落库id获取商品
     * @param $DropId
     * @return
     */
    public function getItemByDropId($DropId)
    {
        $Drop = new Drop();
        $info = $Drop->getInfoById($DropId);
        $arr = explode(';',$info['DropLib']);
//        var_dump($arr);
        $new = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            $weigth = $res[3];//权重
            $max = $res[2];//最大数量
            $min = $res[1];//最小数量
            $ItemId = $res[0];//权重
            for($i=0;$i<$weigth;$i++){
                $arr[] = $ItemId;
            }
            $new[$ItemId] = rand($min,$max);
        }

        mt_srand();
        $ItemId = $arr[array_rand($arr)];
        $Count = $new[$ItemId];

        return [$ItemId=>$Count];
    }

    /**
     * 对象转数组
     */
    private function objectToArray($obj)
    {
        $data = json_encode($obj);
        return json_decode($data,true);
    }
}