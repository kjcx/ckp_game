<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午8:44
 */

namespace App\Protobuf\Result;


class ConsumeResult
{
    public static function encode($data)
    {
        $ConsumeResult = new \AutoMsg\ConsumeResult();
        $LoadConsume = [];
//        $data = [];//查询所有商店产生的收益
        foreach ($data as $item) {
            $LoadConsume[] = LoadConsumeData::encode($item);
        }
        $ConsumeResult->setLoadConsume($LoadConsume);

    }
}