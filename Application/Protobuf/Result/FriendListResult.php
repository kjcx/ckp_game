<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/26
 * Time: 下午4:18
 */

namespace App\Protobuf\Result;
use App\Models\User\Account;

/**
 * 好友
 * Class FriendListResult
 * @package App\Protobuf\Result
 */
class FriendListResult
{
    public static function encode($data)
    {
        $FriendListResult = new \AutoMsg\FriendListResult();
//        $Account = new Account();
//        $data = $Account->find();
        $Friends = [];
        $BlackFriends = [];
        if($data){
            foreach ($data as $datum) {
                if($datum['FriendStatus'] == 5){//黑名单
                    $BlackFriends[] = FriendInfo::encode($datum);
                }else{
                    $Friends[] = FriendInfo::encode($datum);
                }

            }
        }
        $FriendListResult->setFriends($Friends);
        $FriendListResult->setBlacks($BlackFriends);
        return $FriendListResult;
    }
}