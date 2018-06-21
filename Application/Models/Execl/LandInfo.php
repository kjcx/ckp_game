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
        var_dump(111);
        $Day = $this->getDay();
        var_dump($Day);
        $data = Db::table($this->table)->where(['Day'=>(int)$Day])->select();
        return $data;
    }
    /**
    * 获取第几天
    */
    public function getDay()
    {
        $num = $this->redis->get('LandauctionDay');
        var_dump("num" . $num);
        $day_time = $this->redis->ttl('LandauctionDay');
        if(!$num){
            //生产20*20土地
            $this->init_Land();
            $this->redis->setex('LandauctionDay',strtotime(date('Y-m-d',time())),1);
        }elseif(time()-$day_time > 86400 && $num){
            //第二天
            $num = $num + 1;
            $this->redis->set('LandauctionDay',$num,strtotime(date('Y-m-d',time())));
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

    /**
     *土地竞拍价格和身价(货币类型，货币数量，身价值
     * 6,5000,5000
     */
    public function getBiddingPrice()
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getInfoByField('BiddingPrice');
        $res = explode(',',$data['value']);
        return ['Type'=>$res[0],'Count'=>$res[1],'shenjiazhi'=>$res[2]];
    }

    /**
     * 土地竞拍数量(等级，土地数量
     * 1,1;
     * 5,2;
     * 10,3;
     * 15;4,
     * 20,5
     * return 当前允许的土地数量
     */
    public function getAuctionLandNums($level)
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getInfoByField('AuctionLandNums');

        $arr = explode(';',$data['value']);

        $result  = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            if( $level >= $res[0] ){
                $key = $res[0];
            }
            $result[$res[0]] = $res[1];
        }

        return $result[$key];
    }
    /**
     * 获取当前用户已参与和已竞拍数量
     * @param $Uid
     * @return int
     */
    public function getLandinfoNumByUid($Uid)
    {

        $data = $this->getMyLandInfo($Uid);

        //已获得数量
        if($data){
            $num = count($data);
        }else{
            $num = 0;
        }

        $Day = $this->redis->get('LandauctionDay');
        //今日已竞拍数量
        $today_num = $this->getLandInfoNumByDay($Day,$Uid);
        return $today_num + $num;
    }
    /**
     * 土地竞拍失败返还比例(100,10%填10	BidFailureReturn	int	10
     */
    public function getBidFailureReturn()
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getInfoByField('BidFailureReturn');
        return $data['value'];
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
     * 获取个人已竞拍记录
     * @param $uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getMyLandInfo($uid)
    {
        //Status = 1 ;已参与 2 已获得
        $data = Db::table($this->table)->where(['Uid'=>$uid])->select();
        return $data;
    }

    /**
     * 获取今天已竞拍的个数
     * @param $Day
     * @param $Uid
     * @return int
     */
    public function getLandInfoNumByDay($Day,$Uid)
    {
        $num = 0;
        $data  = Db::table($this->table)->where(['Day'=>(int)$Day])->select();
        foreach ($data as $datum) {
            $AuctionRole = $datum['AuctionRole'];
            if(isset($AuctionRole[$Uid])){
                $num++;
            }
        }
        return $num;
    }

    /**
     * 通过pos获取详细信息
     * @param $Pos
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getPosInfoByPos($Pos)
    {
        $data = Db::table($this->table)->where(['Pos'=>$Pos])->find();
        return $data;
    }

    /**
     * 根据坐标id获取数据
     * @param $Poss
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getPosInfoByPoss($Poss)
    {
        $data = Db::table($this->table)->where('Pos','in',$Poss)->select();
        return $data;
    }
}