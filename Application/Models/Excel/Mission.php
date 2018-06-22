<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/23
 * Time: 下午7:55
 */

namespace App\Models\Excel;
use App\Models\Model;
use think\Db;

/**
 * 任务
 * Class Mission
 * @package App\Models\Execl
 */
class Mission extends Model
{

    private $table = 'ckzc.Mission';
    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 通过等级获取任务
     * @param string $level
     * @return array|\PDOStatement|string|\think\Collection
     */
    public function getMissionByLevel($level='0')
    {
        var_dump(333);
        $data =  Db::table($this->table)->where('Level','<=',(string)$level)->select();
        var_dump($data);
        return $data;
    }
}