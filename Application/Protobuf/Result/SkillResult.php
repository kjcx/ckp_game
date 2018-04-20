<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 上午11:14
 */
namespace App\Protobuf\Result;
/**
 * 技能列表
 * Class SkillResult 1031
 * @package App\Protobuf\Result
 */
class SkillResult
{
    public static function encode()
    {
        $SkillResult = new \AutoMsg\SkillResult();
        $skills[601] = 1;
        $skills[602] = 1;
        $skills[603] = 1;
        $skills[604] = 1;
        $skills[605] = 1;
        $skills[606] = 1;
        $skills[607] = 1;
        $skills[608] = 1;
        $skills[609] = 1;
        $skills[610] = 1;
        $SkillResult->setSkills($skills);
        return $SkillResult;
    }
}