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

class Building extends Model
{
    private $table = 'ckzc.Building';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 按类型获取数据
     * @param $Type
     * @return array
     */
    public function getType($Type)
    {
        $data = Db::table($this->table)->where(['Type'=>$Type])->find();
        return $data;
    }

    /**
     * 获取所需等级
     * @param $Type
     * @return mixed
     */
    public function getNeedLv($Type)
    {
        $data = $this->getType($Type);
        if($data){
            return $data['NeedLv'];
        }else{
            return false;
        }
    }

    /**
     * 获取创建所需道具id和价格
     * @param $Type
     * @return bool|mixed
     */
    public function getBuildingCost($Type)
    {

        $data = $this->getType($Type);
        if($data){
            $BuildingCost = $data['BuildingCost'];
            $arr = explode(',', $BuildingCost);
            return ['Type'=>$arr[0],'Count'=>$arr[1]];
        }else{
            return false;
        }
    }
}