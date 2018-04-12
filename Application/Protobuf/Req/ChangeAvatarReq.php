<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午2:48
 */
namespace App\Protobuf\Req;
/**
 * 改变时装请求
 * Class ChangeAvatarReq 1002
 * @package App\Protobuf\Req
 */
class ChangeAvatarReq
{
    public static function decode($data)
    {
        $ChangeAvatarReq = new \AutoMsg\ChangeAvatarReq();
        $ChangeAvatarReq->mergeFromString($data);
        $item = $ChangeAvatarReq->getId()->getIterator();
        $arr = [];
        foreach ($item as $k =>$v) {
            $arr[] = $v;
        }
        return $arr;
    }
}