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

        $arr = [];
        if(is_array($data) && count($data)>0){
            if(count($data) == count($data, 1)){ //一维数组
                $FriendInfo = new \AutoMsg\FriendInfo();
                $Name = $data['nickname'];
                $Level = $data['level'];
                $SocialStatus = $data['shenjiazhi'];
                $Status = $data['status'];
                $AddTime = time();
                $ApplyTime = time();
                $Icon = $data['icon'];
                $RoleId = $data['id'];
                $ShopId = 1;// 打工店铺
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
                $FriendInfo->setWorkCompany($WorkCompany);
                return  $FriendInfo;
            }else{//二维数组
                foreach ($data as $datum) {
                    $FriendInfo = new \AutoMsg\FriendInfo();
                    $Name = $datum['nickname'];
                    $Level = $datum['level'];
                    $SocialStatus = $datum['shenjiazhi'];
                    $Status = $datum['status'];
                    $AddTime = time();
                    $ApplyTime = time();
                    $Icon = $datum['icon'];
                    $RoleId = $datum['id'];
                    $ShopId = 1;// 打工店铺
                    $VIP = $datum['vip'];
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
                    $FriendInfo->setWorkCompany($WorkCompany);
                    $arr[] = $FriendInfo;
                }
                return $arr;
            }

        }else{
            return $arr;
        }

    }
}