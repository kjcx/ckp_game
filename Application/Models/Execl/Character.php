<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/18
 * Time: 下午7:27
 */

namespace App\Models\Execl;


use App\Models\Model;
use think\Db;

/**
 * 默认角色信息
 * Class Character
 * @package App\Models\Execl
 */
class Character extends Model
{
    private $table = 'Character';
    public function insert($arr)
    {
       Db::table($this->table)->insert($arr);
    }

    /**
     * 按性别获取默认值信息 男id=1 女id=2
     * @param string $id
     */
    public function getInfoById($id='')
    {
        $data = Db::table($this->table)->where(['Id'=>$id])->find();
        return $data;
    }
}