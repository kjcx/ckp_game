<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/9
 * Time: 下午2:49
 */
namespace App\Models\BagInfo;
use App\Models\Model;
use think\Db;

/**
 * 道具类
 * Class Item
 * @package App\Models\BagInfo
 */
class Item extends Model
{


    public function getItem($arr)
    {
        $data = Db::table('item')->where(['Id'=>(string)$arr['ItemId']])->find();
//        var_dump($data);
        return $data;
    }

    /**
     * 获取道具总价
     * @param $arr
     * @param int $type 1 购买 2出售
     * @return array
     */
    public function getPriceType($arr,$type=1)
    {
        $data = $this->getItem($arr);
        if($type == 1){
            $gold_type = $this->goldType($data['Cost']);//0是道具id记价格类型，1具体价格
            $sum =  $gold_type[1] * $arr['Count'];
            return ['code'=>1000,'msg'=>'ok','type'=>$gold_type[0],'sum'=>$sum];
        }elseif ($type == 2){
            //判断是否可以快速出卖
            $gold_type = $this->goldType($data['Sell']);//0是道具id记价格类型，1具体价格
            if($this->sellyn($data)){
                $sum = $gold_type[1] * $arr['Count'];
            }else{
                return ['code'=>1001,'msg'=>'不可售卖','type'=>$gold_type[0],'sum'=>0];
            }
            return ['code'=>1000,'msg'=>'ok','type'=>$gold_type[0],'sum'=>$sum];
        }

    }

    /**
     * 判断是否可以快速出卖
     */
    public function sellyn($data)
    {
        if($data['sellyn']){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 购买或者出售 金币类型
     * @param $price
     * @return array
     */
    public function goldType($price)
    {
        $arr = explode(',',$price);
        return $arr;
    }
}