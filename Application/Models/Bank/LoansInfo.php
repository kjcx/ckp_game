<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/23
 * Time: 下午6:06
 */

namespace App\Models\Bank;


use think\Db;

/**
 * 贷款
 * Class LoansInfo
 * @package App\Models\Bank
 */
class LoansInfo
{
    public $table = 'ckzc.LoansInfo';
    public function create($data)
    {
//        贷款状态	LoansStatus
//        没有贷款	NoLoans	1
//        贷款中	InTheLoan	2
//        强制还款中	MandatoryRepayment	3
//        已还清	Done	4
        $data['CreateTime'] = time();
        $data['WhetherTheLoan'] = 2;
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return Db::getLastInsID();
        }else{
            return false;
        }
    }

    /**
     * 获取用户数据
     * @param $uid
     * @return array|bool|false|\PDOStatement|string|\think\Collection
     */
    public function getLoanByUid($uid)
    {
        $data = Db::table($this->table)->where('WhetherTheLoan','in','2,3')->select();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 通过id获取记录
     * @param $id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id)
    {
        $data = Db::table($this->table)->where(['_id'=>(string)$Id])->find();
        return $data;
    }
}