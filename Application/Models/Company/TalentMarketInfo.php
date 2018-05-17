<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午5:05
 */

namespace App\Models\Company;


use App\Models\Execl\GameConfig;
use App\Models\Model;
use think\Db;

/**
 * 人才市场
 * Class TalentMarketInfo
 * @package App\Models\Company
 */
class TalentMarketInfo extends Model
{
    public $table = 'TalentMarketInfo';

    /**
     * 通过用户id 获取用户刷新信息
     * @param $Uid
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoByUid($Uid)
    {
        $TodayTime = strtotime(date('Y-m-d'));
        $rs = Db::table($this->table)->where('Uid',$Uid)->where('CreateTime','>=',$TodayTime)->find();
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 创建记录
     * @param $Uid
     * @return int|string
     */
    public function Create($Uid)
    {
        $data['Uid'] = $Uid;
        $data['CreateTime'] = time();
        $Num =1;
        $data['Num'] = $Num;//刷新次数
        $data['LastTime'] = 0;//上次刷新时间
        $rs = Db::table($this->table)->insert($data);
        return $rs;
    }

    /**
     * 修改记录次数和时间
     * @param $arr 上一次记录
     * @param $IsFree 是否免费
     * @return bool|int|string
     */
    public function UpdateNum($arr,$IsFree=false)
    {

        $data['CreateTime'] = time();
        if($IsFree){
            //免费刷新不计入次数
            $data['LastTime'] = time();
        }else{
            $data['Num'] = $arr['Num'] + 1;
        }

        $rs = Db::table($this->table)->where(['_id'=>(string)$arr['_id']])->update($data);
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 人才市场刷新消耗
     */
    public function getPersonnelRefresh()
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getInfoByField('PersonnelRefresh');
        return $data;
    }

    /**
     * 人才市场刷新时长(分钟
     */
    public function getTalentMarketTime()
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getInfoByField('TalentMarketTime');
//        var_dump($data);
        return $data;
    }

    /**
     * 设置上一次刷新时间
     * @param $Uid
     * @return bool
     */
    public function setLastTime($Uid)
    {
        $rs = Db::table($this->table)->where('Uid',$Uid)->update(['LastTime'=>time()]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
}