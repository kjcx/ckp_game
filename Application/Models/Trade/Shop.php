<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/14
 * Time: 下午5:00
 * Time: 下午2:29
 */

namespace App\Models\Trade;

use App\Models\Item\Item;
use App\Models\User\Account;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;

class Shop
{
    /**
     * 购买商店道具
     * @param int $uid
     * @param array $ids
     * @return bool
     */
    public function Buy(int $uid, array $ids)
    {
        //1.查询购买道具的详细信息
        $item = new Item();
        $data_item = $item->getItemIds($ids);
//        var_dump("查询购买道具的详细信息");
//        var_dump($data_item);
        //2.查询购买道具在掉落库的数量
        $item_info = $this->getItemsInfo($uid,$data_item);
//        var_dump("查询购买道具在掉落库的数量");
//        var_dump($item_info);
        //3.计算道具所需金币 每个类型的总价格
        $data_type_price = $this->getItemsPrice($item_info);
//        var_dump($data_type_price);
        //4.判断金额是否足够
        $bool = $this->IsAllowedBuy($uid,$data_type_price);
        if($bool){
            //足够 扣掉背包数据
            return true;
        }else{
            //金币不足
            return false;
        }
    }

    /**
     * 验证是否可以购买
     * @param int $uid
     * @param array $data
     * @return bool
     */
    public function IsAllowedBuy(int $uid, array $data)
    { 
        //1.获取用户背包信息
        $rolebag = new RoleBag();
        foreach ($data as $k =>$v) {
            //$k 道具id
            $count = $rolebag->getUserGoldByUid($uid,$k);
            if($count < $v){
                return false;
            }
        }
        return true;
    }

    /**
     * 获取道具价格
     * @param array $items
     * @return array
     */
    public function getItemsPrice(array $items)
    {
        $sum = 0;
        foreach ($items as $item) {
            if(stripos($item['Cost'],',')){
                $cost = explode(',',$item['Cost']);
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
     * 获取个人掉落库数据
     * @param int $uid
     * @return array
     */
    public function getDrop(int $uid)
    {
        return [
            ['Id'=>1011,'Count'=>4],
            ['Id'=>1021,'Count'=>5],
            ['Id'=>1031,'Count'=>6],
        ];
    }

    /**
     * 获取购买道具信息
     * @param int $uid
     * @param array $items
     * @return array
     */
    public function getItemsInfo(int $uid,array $items)
    {
        $drop = $this->getDrop($uid);
        foreach ($items as &$item) {
            foreach ($drop as $v) {
                $id = $v['Id'];
                var_dump("===>" .$item['Id'] ."====>" . $v['Id']);
                if($item['Id'] == $id){
                    $item['Count'] = $v['Count'];
                }
            }

        }
        return $items;
    }
}