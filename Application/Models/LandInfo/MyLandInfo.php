<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午1:51
 */

namespace App\Models\LandInfo;


use App\Models\Model;
use think\Db;

class MyLandInfo extends Model
{
    public $table = 'ckzc.LandInfo';

    /**
     * 创建记录
     * @param $data
     * @return bool|int|string
     */
    public function create($data)
    {
        $data['CreateTime'] = time();
        $data['Status'] = 1;//已参与
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 获取个人已竞拍记录
     * @param $uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getMyLandInfo($uid)
    {
        //Status = 1 ;已参与 2 已获得
        $data = Db::table($this->table)->where(['Status'=>2])->select();
        return $data;
    }

    /**
     * 获取第几条
     */
    public function getDay()
    {
        $num = $this->redis->get('LandauctionDay');
        $day_time = $this->redis->ttl('LandauctionDay');
        if(time()-$day_time > 86400){
            //第二天
            $num = $num + 1;
            $this->redis->set('LandauctionDay',$num,time());
        }else{
            $this->redis->sAdd('LandauctionDay',1,time());
            //生产20*20土地

        }
        return $num;
    }

    /**
     * 获取今日竞拍土地列表
     * @return array
     */
    public function getLandInfoByDay()
    {
        $num = $this->getDay();
        $data = [];
//        for ($i=0;$i<20;$i++){
//            $data[] = ['Pos'=>($day * 1000 + $i),'Gold'=>300,'AuctionRole'=>[],'CreateTime'=>0];
//        }
        //Db::table($this->table)->insertAll($data);
        $data = Db::table($this->table)->select();
        return $data;
    }

    /**
     * 修改土地竞拍人信息
     * @param $data
     * @return bool
     */
    public function updateAuctionRole($data)
    {
        $AuctionRole = [$data['Uid']=>$data['Name']];
        $list = Db::table($this->table)->where(['Pos'=>$data['Pos']])->find();
        $AuctionRole = $list['AuctionRole'];
        $AuctionRole[(string)$data['Uid']] = $data['Name'];
        $rs = Db::table($this->table)->where(['Pos'=>$data['Pos']])->update(['AuctionRole'=>$AuctionRole]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取当天某一块土地信息
     * @param $Pos
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getPosInfoByPos($Pos)
    {
        $data = Db::table($this->table)->where('Pos',$Pos)->find();
        return $data;
    }


}