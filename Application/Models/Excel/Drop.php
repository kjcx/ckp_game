<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午3:48
 */

namespace App\Models\Excel;

use App\Models\Model;
use think\Db;

class Drop extends Model
{
    private $table = 'ckzc.Excel_Drop';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取提条记录
     * @param $Id
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->where(['Id'=>(int)$Id])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    /**
     * 获取掉落库
     * @param $DropLibId
     * @return array
     */
    public function getRandDropLib($DropLibId)
    {
        $data = $this->getInfoById($DropLibId);
        $DropLib = $data['DropLib'];
        $arr = explode(';',$DropLib);
        foreach ($arr as $item) {
            $res = explode(',',$item);//每一个数据数组包含id 随机最小值 最大值 概率
            $quanzhong = $res[3];
            for($i=0;$i<$quanzhong;$i++){
                $arr_quanzhong[] = $res[0];
            }
            $arr_min_max[$res[0]] = [$res[1],$res[2]];//最小值，最大值
//            $arr_min_max[$res[0]] = [$res[1],10];
        }
        mt_srand();
        $ItemId = $arr_quanzhong[array_rand($arr_quanzhong)];
        mt_srand();
        $num = mt_rand($arr_min_max[$ItemId][0],$arr_min_max[$ItemId][1]);
        return ['ItemId'=>$ItemId,'Count'=>$num];
    }

}