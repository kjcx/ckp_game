<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午2:32
 */

namespace App\Models\Staff;


use App\Models\Model;
use think\Db;

class LottoLog extends Model
{
    public $table = 'LottoLog';

    /**
     * 创建记录
     * @param $data
     */
    public function create($data)
    {
        $data['CreateTime'] = time();
        Db::table($this->table)->insert($data);
    }

    /**
     * 获取当前用户已经抽奖次数
     * @param $Uid 用户id
     * @param $Type 类型123
     * @return int|string
     */
    public function getNumByUid($Uid,$Type)
    {
        $today = strtotime(date('Y-m-d'));
        $num = Db::table($this->table)->where(['Uid'=>$Uid,'Type'=>$Type])->where('CreateTime','>=',$today)->count();
        if($num){
            return $num;
        }else{
            return 0;
        }
    }

    /**
     * 获取上一次抽奖时间
     * @param $Uid
     * @param $Type
     * @return int
     */
    public function getLastTimeByType($Uid,$Type)
    {
        $data = Db::table($this->table)->where(['Uid'=>$Uid,'Type'=>$Type])->order('CreateTime desc')->find();
        if($data){
            return $data['CreateTime'];
        }else{
            return 0;
        }
    }
}