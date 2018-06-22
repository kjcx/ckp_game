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
        $data = $SignInfo->getSignMonthInfoByUid($uid);
        $LoaSignInfo[date('m',time())] = LoadSignInfoList::encode($data['data']);

        if($data[101]){

            $LoaSignInfo[101] = LoadSignInfoList::encode([['Day'=>7,'IsSign'=>true]]);
        }else{
            $LoaSignInfo[101] = LoadSignInfoList::encode([['Day'=>7,'IsSign'=>false]]);
        }
        if($data[102]){
            $LoaSignInfo[102] = LoadSignInfoList::encode([['Day'=>14,'IsSign'=>true]]);
        }else{
            $LoaSignInfo[102] = LoadSignInfoList::encode([['Day'=>14,'IsSign'=>false]]);
        }
        if($data[103]){
            $LoaSignInfo[103] = LoadSignInfoList::encode([['Day'=>21,'IsSign'=>true]]);
        }else{
            $LoaSignInfo[103] = LoadSignInfoList::encode([['Day'=>21,'IsSign'=>false]]);
        }

        if($data[104]){
            $LoaSignInfo[104] = LoadSignInfoList::encode([['Day'=>28,'IsSign'=>true]]);
        }else{
            $LoaSignInfo[104] = LoadSignInfoList::encode([['Day'=>28,'IsSign'=>false]]);
        }
        $SignResult->setLoaSignInfo($LoaSignInfo);
        $str = $SignResult->serializeToString();
        return $str;
    }
}