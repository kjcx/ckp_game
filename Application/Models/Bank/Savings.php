<?php
/**
 * Created by Vs Code.
 * User: chy
 * Date: 2018/5/7
 * Time: pm 16:48
 * 储蓄功能
 */

namespace App\Models\Bank;

use App\Models\BagInfo\Bag;
use App\Models\Item\Item;
use App\Models\User\Account;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;

use think\Db;

class Savings extends Model
{
    private $table = '_GameConfig';
    /**
     * 存款功能
     * @param  $uid  用户id
     * @param  $savingId 配置表id
     * @param  $moneyCount  存款数额
     * @param  $moneyId   存款类型
     * @return int -1 参数不对 -2 没有足够的金钱
     */
    public function Deposit(int $uid,int $savingId,int $moneyCount,int $moneyId){
        //参数检查
        if($moneyCount<=0 || $uid <=0 || $savingId <=0 || $moneyId<=0){
            return -1;
        }

        //判断货币数额是否足够
        $roleBag = new RoleBag();
      $bool=  $roleBag->checkUserGoldCount($uid,$moneyCount,$moneyId);
      if(!$bool){
          return -2;    //货币不足
      }

      //读取配置表
        $config = Db::table($this->table)->where(['Id'=>$id])->find();


        $bag = new Bag();

       if( !$bag->delBag($moneyId,$moneyCount)){
           return -3;   //扣除货币失败
       }

       //读取配置表
    }

}