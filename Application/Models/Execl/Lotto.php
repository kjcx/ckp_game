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

class Lotto extends Model
{
    private $table = 'ckzc.Lotto';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取记录信息
     * @param $Id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getLootoInfo($Id)
    {
       $data = Db::table($this->table)->where(['Id'=>$Id])->find();
       return $data;
    }
    /**
     * 根据招聘抽奖id获取每天免费抽取次数
     * @param $Id
     * @return
     */
    public function  getDayFreeNum($Id)
    {
        $data = Db::table($this->table)->field('Round')->where(['Id'=>$Id])->find();
        return $data['Round'];
    }

    /**
     * 获取抽奖需要道具和数量
     * @param $Type
     * @return array|bool
     */
    public function getMoney($Type)
    {
        $data = Db::table($this->table)->field('Money')->where(['Id'=>$Type])->find();
        if($data){
            $res = explode(',',$data['Money']);
            return ['Type'=>$res[0],'Count'=>$res[1]];
        }else{
            return false;
        }
    }

    /**
     * 获取每次抽取时间间隔
     * @param $Type
     * @return int
     */
    public function getTime($Type)
    {
        $data = Db::table($this->table)->field('Time')->where(['Id'=>$Type])->find();
        if($data){
            return $data['Time'];
        }else{
            return 0;
        }
    }

    /**
     * 获取所有
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAll()
    {
        $data = Db::table($this->table)->select();
        return $data;
    }


}