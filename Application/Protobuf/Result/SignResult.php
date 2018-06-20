<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 上午11:35
 */

namespace App\Protobuf\Result;

/**
 * 返回签到结果
 * Class SignResult
 * @package App\Protobuf\Result
 */
class SignResult
{
    public static function encode($data)
    {
        //查询用户签到情况

        $SignResult = new \AutoMsg\SignResult();
        for($i=1;$i<=31;$i++){
            $data[]  = ['Day'=>$i,'IsSign'=>true];
        }
        $LoaSignInfo[date('m',time())] = LoadSignInfoList::encode($data);
        $SignResult->setLoaSignInfo($LoaSignInfo);
        $str = $SignResult->serializeToString();
        return $str;
    }
}