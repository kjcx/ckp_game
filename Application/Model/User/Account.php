<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午6:13
 */
namespace App\Model\User;
use App\Model\Model;

class Account extends Common
{
    /**
     * register 注册用户
     * @param $data
     */
    public function register($data){
        var_dump($this->Di);
    }

    /**
     * userinfo 获取用户信息
     * @param $where
     */
    public function userinfo($where)
    {
        
    }
}