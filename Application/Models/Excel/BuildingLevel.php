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

/**
 * 店铺等级
 * Class BuildingLevel
 * @package App\Models\Excel
 */
class BuildingLevel extends Model
{
    private $table = 'ckzc.BuildingLevel';
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

    /**
     * 验证道具是否满足
     * @param $NeedItems
     * @param $ShopType
     * @return array
     */
    public function getNeedItems($NeedItems,$ShopType)
    {
        $arr = explode(';',$NeedItems);
        $new_list = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            $ShopType = $res[0];
            unset($res[0]);
            $new = [];
//            var_dump($res);
            foreach ($res as $k =>$v) {
                if($k % 2 == 1){
                    $list['ItemId'] = $v;
                }else{
                    $list['Count'] = $v;
                    $new[] = $list;
//                    var_dump($list);
                }
            }
            $new_list[$ShopType] = $new;
        }
        return $new_list[$ShopType];
    }
}