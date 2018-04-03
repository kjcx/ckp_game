<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午8:28
 */
namespace App\Model\User;
use App\Model\Model;

class  Role extends Model
{
    /**
     * 获取用户角色id
     * @param $uid
     */
    public function get($uid){
        $data = $this->dbConnector()->query("select * from ckzc_role where uid = $uid");
        var_dump($data);
    }
}