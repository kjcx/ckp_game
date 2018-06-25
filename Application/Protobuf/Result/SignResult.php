<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 上午11:35
 */

namespace App\Protobuf\Result;
use App\Models\Sign\SignInfo;

/**
 * 返回签到结果
 * Class SignResult
 * @package App\Protobuf\Result
 */
class SignResult
{
    public static function encode($uid)
    {
        //查询用户签到情况

        $SignResult = new \AutoMsg\SignResult();
        $SignInfo = new SignInfo();
        $data = $SignInfo->getRedisSignMonthInfoByUid($uid);
        $LoaSignInfo[date('m',time())] = LoadSignInfoList::encode($data);
//        $LoaSignInfo[101] = LoadSignInfoList::encode($data[101]);
//        $LoaSignInfo[102] = LoadSignInfoList::encode($data[102]);
//        $LoaSignInfo[103] = LoadSignInfoList::encode($data[103]);
//        $LoaSignInfo[104] = LoadSignInfoList::encode($data[104]);

        $SignResult->setLoaSignInfo($LoaSignInfo);
        $str = $SignResult->serializeToString();
        return $str;
    }
}