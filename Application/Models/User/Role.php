<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午8:53
 */
namespace App\Models\User;
use App\Models\Model;

class Role extends Model
{
    private $table = 'ckzc_role';
    public function getRole($uid)
    {
        $arr = $this->mysql->where("uid",$uid)->getOne($this->table);
        return $arr;
    }

    /**
     * 创建角色
     * @param $data
     * @return bool
     */
    public function createRole($data)
    {
        //后期事务
        $rs = $this->mysql->insert($this->table,$data);
        if($rs){
            $arr['rid'] = $rs;//角色id
            $arr['uid'] = $data['uid'];//用户id
            $arr['maxsum'] = 999;//背包最大数量
            $arr['usesum'] = 0;//已使用
            $arr['items'] = json_encode([]);//已获取道具数量
            $res = $this->createRoleBag($arr);
            if($res){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 创建背包数据
     */
    public function createRoleBag($data)
    {
        $RoleBag = new RoleBag();
        $rs = $RoleBag->createRoleBag($data);
        return $rs;
    }
}