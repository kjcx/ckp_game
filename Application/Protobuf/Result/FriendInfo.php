<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/26
 * Time: 下午4:48
 */

namespace App\Protobuf\Result;

/**
 * 好友信息
 * Class FriendInfo
 * @package App\Protobuf\Result
 */
class FriendInfo
{
    public static function encode($data)
    {

        $FriendInfo = new \AutoMsg\FriendInfo();
        $Name = $data['nickname'];
        $Level = $data['level'];
        $SocialStatus = $data['shenjiazhi'];
        var_dump($SocialStatus);
        if(isset($data['FriendStatus'])){
            $Status = $data['FriendStatus'];
        }else{
            $Status = 3;
        }
        if(isset($data['AddTime'])){
            $AddTime = $data['AddTime'];
        }else{
            $AddTime = time();
        }

        if(isset($data['ApplyTime'])){
            $ApplyTime = $data['ApplyTime'];
        }else{
            if($Status == 1){
                $ApplyTime = time();
            }else{
                $ApplyTime = 0;
            }

        }
        $Icon = $data['icon'];
        $RoleId = $data['uid'];
        $ShopId = $data['shopid'];// 打工店铺
        $VIP = $data['vip'];
        $WorkCompany = 'KJCX';//打工公司
        $FriendInfo->setName($Name);
        $FriendInfo->setLevel((int)$Level);
        $FriendInfo->setSocialStatus($SocialStatus);
        $FriendInfo->setStatus($Status);
        $FriendInfo->setAddTime($AddTime);
        $FriendInfo->setApplyTime($ApplyTime);
        $FriendInfo->setIcon($Icon);
        $FriendInfo->setRoleId($RoleId);
        $FriendInfo->setShopId($ShopId);
        $FriendInfo->setVIP($VIP);
        $FriendInfo->setWorkCompany($WorkCompany);
        return $FriendInfo;
    }
}