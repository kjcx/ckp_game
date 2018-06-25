<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午2:05
 */

namespace App\Models\Excel;
use App\Models\Model;
use think\Db;

/**
 * 签到表
 * Class Sign
 * @package App\Models\Excel
 */
class Sign extends Model
{
    public $table = 'ckzc.Excel_Sign';

    /**
     * 获取奖励
     * @param $Day
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getReward($Day)
    {
        var_dump(date('M'));
        var_dump($Day);
        $data = Db::table($this->table)->where('Month',date('M'))->where('Day',$Day)->find();
        var_dump($data);

        if($data){
            $res = explode(',',$data);
            return ['ItemId'=>$res[0],'Count'=>$res[1]];
        }else{
            return  [];
        }
    }
}