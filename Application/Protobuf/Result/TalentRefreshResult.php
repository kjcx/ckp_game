<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午5:01
 */

namespace App\Protobuf\Result;

use App\Models\User\Role;

/**
 * 刷新人才市场返回
 * Class TalentRefreshResult 1182
 * @package App\Protobuf\Result
 */
class TalentRefreshResult
{
    public static function encode($uid)
    {
        $TalentRefreshResult = new \AutoMsg\TalentRefreshResult();
        //刷新次数和上次刷新时间
        $Info = TalentMarketInfo::encode($uid);
        $TalentRefreshResult->setInfo($Info);
        $Role = new Role();
        $data = $Role->getListByRand(false);
        $List = [];
        foreach ($data as $item) {
            $List[] = TalentInfo::encode($item);
        }
        $TalentRefreshResult->setList($List);
        $str = $TalentRefreshResult->serializeToString();
        return $str;
    }
}