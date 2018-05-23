<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/21
 * Time: 下午9:40
 */

namespace App\Protobuf\Req;

/**
 * 土地竞拍请求
 * Class GetMapReq 1011
 * @package App\Protobuf\Req
 */
class GetMapReq
{
    public static function decode($data)
    {
        $GetMapReq = new \AutoMsg\GetMapReq();
        $GetMapReq->mergeFromString($data);
        $Poss = $GetMapReq->getPos()->getIterator();//坐标集合
        $Pos = [];
        foreach ($Poss as $pos) {
            $Pos[] = $pos;
        }
        $Zone = $GetMapReq->getZone();//区域
        return ['Pos'=>$Pos,'Zone'=>$Zone];
    }
}