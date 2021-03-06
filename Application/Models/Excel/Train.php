<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午3:48
 */

namespace App\Models\Excel;

use App\Models\Model;
use think\Db;

class Train extends Model
{
    private $table = 'ckzc.Excel_Train';
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
        $data = Db::table($this->table)->where(['Id'=>(int)$Id])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 通过培训次数获取数据
     * @param $Time
     * @return array
     */
    public function getInfoByTrainNum($Time)
    {
        if(!$Time){
            $Time = 1;
        }
        $data = Db::table($this->table)->where('Time',$Time)->find();
//        var_dump($Time);
        $Cost = $data['Cost'];
        $Costs = explode(';',$Cost);
        $arr = [];
        foreach ($Costs as $cost) {
            $res = explode(',',$cost);
            $arr[$Time.'-' .$res[0]] = ['Type'=>$res[1],'Count'=>$res[2]];//1货币类型2 货币数量 (几次+品质)
        }
        return $arr;
    }

}