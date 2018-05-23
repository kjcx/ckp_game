<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午1:11
 */
namespace App\Protobuf\Result;
use App\Models\Model;
use App\Models\Store\DropStore;

/**
 * 返回商店信息
 * Class ShopAllResult 1145
 * @package App\Protobuf\Result
 */
class ShopAllResult extends Model
{
    public static function encode($uid)
    {
//        $ShopAll = new \App\Models\LoadData\ShopAll();
//        $data = $ShopAll->get();//7种类型商品

        $dropShop = new DropStore($uid);
        $data = $dropShop->refreshDropShop();

        $new_data = LoadDropData::drop($data);
        var_dump('ShopAllResult=>LoadDropData');
//        var_dump($new_data);
        $ShopAllResult = new \AutoMsg\ShopAllResult();
        $ShopAllResult->setLoadConsume($new_data);
        $ShopAllResult->setTime(1);
        $ShopAllResult->setDate(time()+(60*180));
//        $ShopAllResult->setHairdressingTime();
//        $ShopAllResult->setMenSWearTime();
//        $ShopAllResult->setOrnamentTime();
//        $ShopAllResult->setWoMenSWearTime();
        $str = $ShopAllResult->serializeToString();

        return $str;
    }
}