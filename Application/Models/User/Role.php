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
     * 设置角色
     * @param $data
     * @return bool
     */
    public function setRole($data)
    {
        $rs = $this->mysql->insert($this->table,$data);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
}