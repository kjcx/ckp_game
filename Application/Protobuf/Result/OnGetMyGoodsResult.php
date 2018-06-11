<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/11
 * Time: 下午6:33
 */

namespace App\Protobuf\Result;

/**
 * 返回交易行自己商品
 * Class OnGetMyGoodsResult
 * @package App\Protobuf\Result
 */
class OnGetMyGoodsResult
{
    public static function ecode($data)
    {
        $OnGetMyGoodsResult = new \AutoMsg\OnGetMyGoodsResult();
        $Goods = [];
        if($data){
            foreach ($data as $item) {
                $Goods[] = DealGoodsUpdate::encode($item);
            }
        }

        $OnGetMyGoodsResult->setGoods($Goods);
    }
}