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

class Train extends Model
{
    private $table = 'Execl_Train';
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
     * 通过培训次数获取数据
     * @param $Time
     * @return array
     */
    public function getInfoByTrainNum($Time)
    {
        $data = Db::table($this->table)->where('Time',$Time)->find();
        $Cost = $data['Cost'];
        $Costs = explode(';',$Cost);
        $arr = [];
        foreach ($Costs as $cost) {
            $res = explode(',',$cost);
            $arr[$Time.'-' .$res[0] ] = ['Type'=>$res[1],'Count'=>$res[2]];//1货币类型2 货币数量
        }
        return $arr;
    }

}