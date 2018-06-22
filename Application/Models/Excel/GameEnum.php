<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/12
 * Time: 下午2:20
 */
namespace App\Models\Excel;
use App\Models\Model;
use think\Db;
class GameEnum extends Model
{
    private $table = 'ckzc.GameEnum';
    private $DayCountInfo = ['GoldToCoin','CoinToGold','GoldToBill'];
    public function insert($arr)
    {
        //插入数据库
        Db::table($this->table)->insert($arr);
    }

    public function find($where)
    {
        $data = Db::table($this->table)->where($where)->find();
        return $data;
    }

    /**
     * 获取金币 充值限额
     * @return array
     */
    public function getDataCountType()
    {
        $data = $this->find(['type'=>'DataCountType']);
        $arr = [];
        foreach ($data['list'] as $item) {
            if(in_array($item['type'],$this->DayCountInfo)){
                $arr[$item['value']] = 0;
            }
        }
        return $arr;
    }

    /**
     * 员工品质
     */
    public function getStaffQuality()
    {
        $data = $this->find(['type'=>'StaffQuality']);
        if($data['list']){
            return $data['list'];
        }else{
        }
    }

    /**
     * 员工属性
     */
    public function getStaffAttr()
    {
        $data = $this->find(['type'=>'StaffAttr']);
        if($data['list']){
            return $data['list'];
        }else{
        }
    }
}