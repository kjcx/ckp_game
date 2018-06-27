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
 * 累计签到奖励
 * Class Topup
 * @package App\Models\Excel
 */
class TotalRewards extends Model
{
    public $table = 'ckzc.Excel_TotalRewards';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取累计签到奖励
     * @param $NeedDays
     * @return array
     */
    public function getRewardByNeedDays($NeedDays)
    {
        $data = Db::table($this->table)->where('NeedDays',$NeedDays)->find();
        $Reward = $data['Reward'];
        $arr = explode(';',$Reward);
        $list =[];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            $list[] = ['ItemId'=>$res[0],'Count'=>$res[1]];
        }
        return $list;
    }
}