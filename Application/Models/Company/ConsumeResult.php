<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午8:54
 */

namespace App\Models\Company;


use App\Models\Model;
use think\Db;

/**
 * 店铺收益
 * Class ConsumeResult
 * @package App\Models\Company
 */
class ConsumeResult extends Model
{
    public $table  = 'ckzc.ConsumeResult';

    /**
     * 获取收益
     */
    public function getConsumeResult($Uid)
    {
        $data = Db::table($this->table)->where(['Uid'=>$Uid])->select();
//        var_dump($data);
        return $data;
    }

    /**
     * 创建收益
     * @param $data
     * @return int|string
     */
    public function create($data)
    {
//        $LoadConsumeData->setShopId();//店铺id
//        $LoadConsumeData->setMoney();//产出的钱
//        $LoadConsumeData->setMoneyType();//产出的钱的类型
//        $LoadConsumeData->setItemCount();//产出的道具
//        $LoadConsumeData->setHarvestDate();//收获时间
//        $LoadConsumeData->setItmeDate();//道具产出时间
        $data['Uid'] = 37;//
        $data['ShopId'] = 1;//
        $data['Money'] = 1;//
        $data['MoneyType'] = 6;//
        $data['ItemCount'] = [151=>1];//
        $data['HarvestDate'] = time();//
        $data['ItmeDate'] = time()- 2*3600;//
        $rs = Db::table($this->table)->insert($data);
        return $rs;
    }
}