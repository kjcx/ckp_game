<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午1:11
 */
namespace App\Protobuf\Result;
use App\Models\Model;

/**
 * 返回商店信息
 * Class ShopAllResult 1145
 * @package App\Protobuf\Result
 */
class ShopAllResult extends Model
{
    public static function encode()
    {
        $ShopAll = new \App\Models\LoadData\ShopAll();
        $data = $ShopAll->get();//7种类型商品

        $new_data = LoadDropData::drop($data);
        $ShopAllResult = new \AutoMsg\ShopAllResult();
        $ShopAllResult->setLoadConsume($new_data);
        $ShopAllResult->setTime(1);
        $ShopAllResult->setDate(time()+3600);
//        $ShopAllResult->setHairdressingTime();
//        $ShopAllResult->setMenSWearTime();
//        $ShopAllResult->setOrnamentTime();
//        $ShopAllResult->setWoMenSWearTime();
        $str = $ShopAllResult->serializeToString();
        return $str;
    }
}