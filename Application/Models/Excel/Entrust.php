<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午2:05
 */

namespace App\Models\Excel;
use App\Models\Model;
use App\Models\User\Role;
use think\Db;

/**
 * 委托任务
 * Class Npc
 * @package App\Models\Excel
 */
class Entrust extends Model
{
    public $table = 'ckzc.Excel_Entrust';

    /**
     * 通过等级获取信息
     * @param $Level
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoByLevel($Level)
    {
        $data = Db::table($this->table)->where('RoleLv',(int)$Level)->find();
        if($data){
            return $data;
        }else{
            return [];
        }
    }

    /**
     * 获取升级所需道具
     * @param $OrderForm
     * @return array
     */
    public function getItemByOrderForm($OrderForm)
    {
        $arr = explode(';',$OrderForm);
        $new = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            $ItemId = $res[0];//道具id
            $min = $res[1];//最小值
            $max = $res[2];//最大值
            mt_srand();
            $Count = rand($min,$max);
            $new[] = ['ItemId'=>$ItemId,'Count'=>$Count];
        }
        return $new;
    }

    /**
     * 任务di 获取奖励
     * @param $Id
     * @return array
     */
    public function getAwardById($Id)
    {
        $data = Db::table($this->table)->where('Id',$Id)->find();
        $Award = $data['Award'];
        $arr = explode(';',$Award);
        $list = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            $ItemId = $res[0];
            $Count = $res[1];
            $list[] = ['ItemId'=>$ItemId,'Count'=>$Count];
        }
        return $list;
    }
}