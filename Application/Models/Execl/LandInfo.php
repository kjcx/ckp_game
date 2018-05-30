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

class LandInfo extends Model
{
    private $table = 'ckzc.Execl_LandInfo';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }
    /**
     * 获取今日竞拍土地列表
     * @return array
     */
    public function getTodayLandInfo()
    {
        $num = $this->getDay();
        $start = $num *1000;
        $end = $start + 19;
        $data = Db::table($this->table)->where('Pos','>=',$start)->where('Pos','<=',$end)->select();
        return $data;
    }
    /**
    * 获取第几天
    */
    public function getDay()
    {
        $num = $this->redis->get('LandauctionDay');
        $day_time = $this->redis->ttl('LandauctionDay');
        if(time()-$day_time > 86400){
            //第二天
            $num = $num + 1;
            $this->redis->set('LandauctionDay',$num,strtotime(date('Y-m-d',time())));
        }else{
            $this->redis->sAdd('LandauctionDay',1,time());
            //生产20*20土地

        }
        return $num;
    }
    /**
     * 初始化
     */
    public function init()
    {
        //今日0晨
        $today = strtotime(date('Y-m-d',time()));
        for ($j=1;$j<=20;$j++){
            for ($i=0;$i<20;$i++){
                $day = $today +  86400 * ($j-1);
                $data[] = ['Pos'=>($j * 1000 + $i),'Gold'=>300,'AuctionRole'=>[],'Date'=>date('Y-m-d',$day),'Today'=>$day];
            }
        }
        Db::table('Execl_LandInfo')->insertAll($data);
    }
}