<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/12
 * Time: 下午2:20
 */
namespace App\Models\Execl;
use App\Models\Model;
use think\Db;
class GameEnum extends Model
{
    private $table = 'GameEnum_1';
    private $DayCountInfo = ['GoldToCoin','CoinToGold','GoldToBill'];
    public function insert($arr)
    {
        //插入数据库
        Db::table($this->table)->insert($arr);
    }

    public function find($where)
    {
        $data = Db::table($this->table)->where($where)->find();
        var_dump(11111111);
        var_dump($data);
        return $data;
    }

    /**
     * 获取金币 充值限额
     * @return array
     */
    public function getDataCountType()
    {

        var_dump("============>>>>>>");

        $data = $this->find(['type'=>'DataCountType']);


        $arr = [];
        foreach ($data['list'] as $item) {
            if(in_array($item['type'],$this->DayCountInfo)){
                $arr[$item['value']] = 0;
            }
        }
        return $arr;
    }
}