<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午3:58
 */

namespace App\Protobuf\Result;

/**
 * npc列表
 * Class NpcListResult
 * @package App\Protobuf\Result
 */
class NpcListResult
{
    public static function encode($data)
    {
        $NpcListResult = new \AutoMsg\NpcListResult();
        $NpcData = [];
        foreach ($data as $NpcId =>$value) {
            if($value){
                $Status = true;
            }else{
                $Status = false;
            }
            $NpcData[] = NpcInfo::encode(['NpcId'=>$NpcId,'Status'=>$Status]);
        }
        $NpcListResult->setNpcData($NpcData);
        $str = $NpcListResult->serializeToJsonString();
        return $str;
    }
}