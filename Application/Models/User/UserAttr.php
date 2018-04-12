<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午5:22
 */
namespace App\Protobuf\User;
use App\Models\Model;

/**
 * 用户属性
 * Class UserAttr
 * @package App\Protobuf\User
 */
class UserAttr extends Model
{
    private $table = 'ckzc_userattr';
    public  function setUserAttr($data)
    {
        return $this->mysql->insert($this->table,$data);
    }
}