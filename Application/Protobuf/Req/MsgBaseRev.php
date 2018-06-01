<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/30
 * Time: 下午1:24
 */

namespace App\Protobuf\Req;


class MsgBaseRev
{
    public static $conn;
    public static $MsgBaseRev;
    //创建一个用来实例化对象的方法
    public static function getInstance(){
        if(!(self::$conn instanceof self)){
            self::$conn = new self;
            self::$MsgBaseRev = new \AutoMsg\MsgBaseRev();
            var_dump('1111');
        }


        return self::$MsgBaseRev;
    }
    public static function decode($data)
    {
        self::getInstance()->mergeFromString($data);
        $MsgId = self::getInstance()->getMsgId();
        $Data = self::getInstance()->getData();
        return ['MsgId'=>$MsgId,'Data'=>$Data];
    }
}