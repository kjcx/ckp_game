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

/**
 * 店铺等级
 * Class BuildingLevel
 * @package App\Models\Execl
 */
class BuildingLevel extends Model
{
    private $table = 'BuildingLevel';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取信息通过等级
     * @param $level
     * @return $this|bool
     */
    public function getInfoByLevel($level)
    {
        $data= Db::table($this->table)->where(['Id'=>$level])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }
    /**
     * 通过等级获取店铺限制员工数量
     * @param $level
     * @return int
     */
    public function getEmployeeLimitByLevel($level)
    {
        $data= Db::table($this->table)->field('ClerkNums')->where(['Id'=>$level])-find();
        if($data){
            return $data['ClerkNums'];
        }else{
            return 0;
        }
    }
}