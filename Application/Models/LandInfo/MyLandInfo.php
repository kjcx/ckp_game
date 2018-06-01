<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午1:51
 */

namespace App\Models\LandInfo;


use App\Models\Model;
use think\Db;

/**
 * 个人竞拍已获得
 * Class MyLandInfo
 * @package App\Models\LandInfo
 */
class MyLandInfo extends Model
{
    public $table = 'ckzc.MyLandInfo';

    /**
     * 创建记录
     * @param $data
     * @return bool|int|string
     */
    public function create($data)
    {
        $data['CreateTime'] = time();
        $data['Status'] = 1;//已获得
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 获取个人已竞拍记录
     * @param $uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getMyLandInfo($uid)
    {
        //Status = 1 ;已参与 2 已获得
        $data = Db::table($this->table)->where(['Status'=>2])->select();
        return $data;
    }

}