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

/**
 * 个人竞拍已获得
 * Class MyLandInfo
 * @package App\Models\LandInfo
 */
class MyLandInfo extends Model
{
    public $table = 'ckzc.Execl_LandInfo';

    /**
     * 创建记录
     * @param $data
     * @return bool|int|string
     */
    public function create($data)
    {
        $data['CreateTime'] = time();
        $data['Status'] = 1;//已获得
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
        $data = Db::table($this->table)->where(['Uid'=>$uid])->select();
        return $data;
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
}