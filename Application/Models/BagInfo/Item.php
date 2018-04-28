<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/9
 * Time: 下午2:49
 */
namespace App\Models\BagInfo;
use App\Models\Model;
use App\Models\User\RoleBag;
use think\Db;

/**
 * 道具类
 * Class Item
 * @package App\Models\BagInfo
 */
class Item extends Model
{
    private $table = 'item';

    /**
     * 根据id获取道具信息
     * @param $ItemId
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function getItemByid($ItemId)
    {
        //Db::setConfig(['database' => 'ckzc']); //切库
        $data = Db::table($this->table)->where(['Id'=>(int)$ItemId])->find();
        return $data;
    }

    /**
     * 根据ids获取道具信息
     * @param $ids
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getItemByIds($ids)
    {
        $data = Db::table($this->table)->where('Id','in',$ids)->select();
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
        $ItemId = $arr['ItemId'];
        $data = $this->getItemByid($ItemId);
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
     * @param $data
     * @return bool
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

    /**
     * 获取多个道具价格
     * @param $ids
     * @return array
     */
    public function getPriceByIds($ids)
    {
        $data = $this->getItemByIds($ids);
        $Cost = 0;
        $type = '';
        foreach ($data as $datum) {
            $gold_type = $this->goldType($datum['Cost']);//0是道具id记价格类型，1具体价格
            $Cost +=  $gold_type[1];
            $type = $gold_type[0];
        }
        return ['sum'=>$Cost,'type'=>$type];
    }
}