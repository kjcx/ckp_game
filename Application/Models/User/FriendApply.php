<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/28
 * Time: 下午3:18
 */

namespace App\Models\User;


use App\Models\Model;

/**
 * 好友
 * Class FriendApply
 * @package App\Models\User
 */
class FriendApply extends Model
{
    private $table = 'ckzc_friend_apply';

    /**
     * 验证是否是好友
     * @param $uid 本人uid
     * @param $fuid 好友uid
     * @return bool
     */
    public function checkIsFriend($uid,$fuid)
    {
        $data = $this->mysql->where('uid',$uid)->where('fuid',$fuid)->getOne($this->table);
        if($data){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 添加好友申请
     * @param $uid 本人id
     * @param $fuid 好友id
     * @return bool
     */
    public function addFriendApply($uid,$fuid)
    {
        if($this->checkIsFriend($uid,$fuid)){
            return false;
        }else{
            $data = ['uid'=>$uid,'fuid'=>$fuid,'apply_time'=>time(),'status'=>1];
            $id = $this->mysql->insert($this->table,$data);
            return $id;
        }
    }

    /**
     * 获取好友
     * @param $uid
     * @return array
     */
    public function getFriends($uid)
    {
        $data = $this->mysql
            ->where('f.uid',$uid)
            ->join('ckzc_role r',"f.fuid = r.uid",'LEFT')
            ->where('f.status',1)->get($this->table ." f");
        return $data;
    }
    public function passFriendApply()
    {
        
    }
}