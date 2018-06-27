<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午2:05
 */

namespace App\Models\Excel;
use App\Models\Model;
use think\Db;

/**
 * 居民人脉
 * Class Npc
 * @package App\Models\Excel
 */
class Npc extends Model
{
    public $table = 'ckzc.Excel_Npc';
    public $defaulttype = 1;//1，建角自动开放居民2，锁定，需要解锁的居民3，创创，教学引导npc，非居民

    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 解锁需要的道具
     * @param $NpcId
     * @return array
     */
    public function getUnlockItemId($NpcId)
    {
        $data = Db::table($this->table)->where('Id',$NpcId)->find();
        $UnlockItemId = $data['UnlockItemId'];
        $arr = explode(';',$UnlockItemId);
        $list = [];
        foreach ($arr as $item) {
            $res = explode(',',$item);
            if(is_array($res)){
                $list[$res[0]] = $res[1];
            }
        }
        return $list;
    }

    /**
     * 获取默认npc
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getDefault()
    {
        $defaulttype = $this->defaulttype;
        $data = Db::table($this->table)->where('Type',$defaulttype)->select();
        return $data;
    }

    /**
     * 初始化npc数据
     */
    public function getNpcInit()
    {
        $data = Db::table($this->table)->where('Type','in',[1,2])->order('Type')->select();
        $arr = [];
        $list = [];
        foreach ($data as $datum) {
            $arr['NpcId'] = $datum['Id'];
            $arr['CurrentFavorability'] = 0;//好感度
            $arr['FavorabilityLevel'] = 0;//品质
            if($datum['Type'] == 1){
                $arr['Status'] = 1;//默认解锁
            }else{
                $arr['Status'] = 0;//没解锁
            }
            $list[] = $arr;
        }
        return $list;
    }
}