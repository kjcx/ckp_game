<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午2:32
 */

namespace App\Models\Staff;


use App\Models\Execl\Lotto;
use App\Models\Model;
use think\Db;

class LottoLog extends Model
{
    public $table = 'ckzc.LottoLog';

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
        $TodayTime = strtotime(date('Y-m-d'));
        $data = Db::table($this->table)->where(['Uid'=>$Uid,'Type'=>$Type])->where('CreateTime','>=',$TodayTime)->order('CreateTime','desc')->find();
        if($data){
            return $data['CreateTime'];
        }else{
            return 0;
        }
    }

    /**
     * 获取今日抽奖数据
     * @param $Uid
     * @return array|bool|false|\PDOStatement|string|\think\Collection
     */
    public function getTodayInfoByUid($Uid)
    {
        $TodayTime = strtotime(date('Y-m-d'));
        $data = Db::table($this->table)->where('Uid',$Uid)->where('CreateTime','>=',$TodayTime)->select();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 获取当前时间抽奖次数和时间
     * @param $uid
     * @return array
     */
    public function getTypeCountStaff($uid)
    {
        $Lotto = new Lotto();
        $data_Lotto = $Lotto->getAll();
        $list = [];
        foreach ($data_Lotto as $item) {
            $today_num = $this->getNumByUid($uid,$item['Type']);
            $LastTime= $this->getLastTimeByType($uid,$item['Type']);
            $count = $item['Round'] - $today_num;
            $arr['Count'] = $count;
            $arr['Date'] = $LastTime;
            $list[$item['Type']] = $arr;
        }
        return $list;
    }
}