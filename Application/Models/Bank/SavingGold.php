<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/23
 * Time: 下午3:39
 */

namespace App\Models\Bank;
use think\Db;

/**
 * 银行贷款存款取款还款
 * Class SavingGold
 * @package App\Models\Bank
 */
class SavingGold
{
    public $table = 'ckzc.SavingGold';
    public function create($data)
    {
        $data['SavingTime'] = time();
        $data['Earnings'] = 0;//收益
        $data['SavingType'] = 2;//定期
        $data['LoadingTime'] = $data['TimeLimit'] * 86400 + $data['SavingTime'];
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return  Db::getLastInsID();
        }else{
            return false;
        }
    }

    /**
     * 通过id获取记录
     * @param $Id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInofById($Id)
    {
        $data = Db::table($this->table)->where(['_id'=>(string)$Id])->find();
        return $data;
    }

    /**
     * 通过uid获取用户数据
     * @param $uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getListByUid($uid)
    {
        $data = Db::table($this->table)->where('Uid',$uid)->select();
        return $data;
    }
}