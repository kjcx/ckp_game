<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/9
 * Time: 下午8:17
 */

namespace App\Models\Excel;


use App\Models\Model;
use think\Db;

class GameConfig extends Model
{
    public $table = 'ckzc.GameConfig';
    public function getConfig($name)
    {
        $data = Db::table($this->table)->where(['_id'=>$name])->find();
        return $data;
    }

    public function insert($data)
    {
        Db::table($this->table)->insert($data);
    }

    /**
     * 通过Field 获取配置信息
     * @param $Field
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoByField($Field)
    {
        $data = Db::table($this->table)->where(['Field'=>$Field])->find();
        return $data;
    }

    /**
     * 存款配置返回
     * @return array
     */
    public function getInterest()
    {
        $data_GameConfig = $this->getInfoByField('Interest');
        $Interests = explode(';',$data_GameConfig['value']);
        $arr = [];
        foreach ($Interests as $interest) {
            $res = explode(',',$interest);
            $arr[$res[0]] = $res[1];
        }
        return $arr;
    }
    /**
     * 贷款配置返回
     * @return array
     */
    public function getPenaltyGold()
    {
        $data_GameConfig = $this->getInfoByField('PenaltyGold');
        $Interests = explode(';',$data_GameConfig['value']);
        $arr = [];
        foreach ($Interests as $interest) {
            $res = explode(',',$interest);
            $arr[$res[0]] = $res[1];
        }
        return $arr;
    }

    /**
     * 获取水果机配置
     */
    public function getFruits()
    {
        $data_GameConfig = $this->getInfoByField('Fruits');
        $Fruits = $data_GameConfig['value'];
        $Fruitss = explode(';',$Fruits);
        $arr = [];
        foreach ($Fruitss as $k => $item) {
            $res = explode(',',$item);
            $arr[$k] = ['Type'=>$res[0],'Count'=>$res[1]];
        }
        return $arr;
    }

    /**
     * 邮件官方名称
     */
    public function getMailNpcName()
    {
        $data_GameConfig = $this->getInfoByField('MailNpcName');
        $MailNpcName = $data_GameConfig['value'];
        return $MailNpcName;
    }

    /**
     * 邮件头像
     */
    public function getMailNpcHead()
    {
        $data_GameConfig = $this->getInfoByField('MailNpcHead');
        $MailNpcHead = $data_GameConfig['value'];
        return $MailNpcHead;
    }

    /**
     * 补签到
     */
    public function getSignGold()
    {
        $data_GameConfig = $this->getInfoByField('SignGold');
        $SignGold = $data_GameConfig['value'];
        return $SignGold;
    }

    /**
     * 获取每日员工每天最大培训次数
     */
    public function getMaxTrainTime()
    {
        $data_GameConfig = $this->getInfoByField('MaxTrainTime');
        $MaxTrainTime = $data_GameConfig['value'];
        return $MaxTrainTime;
    }


}