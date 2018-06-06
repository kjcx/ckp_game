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
        $in_uid = [$uid,$fuid];
        $data = $this->mysql->where('uid',$in_uid,'in')->where('fuid',$in_uid,'in')->getOne($this->table);
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
            $data = ['uid'=>$uid,'fuid'=>$fuid,'apply_time'=>time(),'status'=>3];//向别人申请好友
            $id = $this->mysql->insert($this->table,$data);
            return $id;
        }
    }

    /**
     * 获取好友
     * @param $uid
     * @return array
     */
    public function getFriendInfoByUid($uid)
    {
        $data = $this->mysql
            ->where('f.uid',$uid)
            ->join('ckzc_role r',"f.fuid = r.uid",'LEFT')
            ->where('f.status',1)->get($this->table ." f",null,'r.id,r.vip,r.nickname,r.icon,r.shenjiazhi,r.level,f.status,f.apply_time,f.add_time');
        return $data;
    }

    /**
     * 通过好友申请
     * @param $uid 用户id
     * @param $uids 通过角色集合
     * @return bool
     */
    public function passFriendApply($uid,$uids)
    {
        //1 通过角色id获取用户id
        $data_userinfos = $this->mysql->where('uid',$uids,'in')->get('ckzc_role');
//        var_dump($data_userinfos);
        //2 修改申请人uid 和fuid为自己的 对应的记录
//        $uids = array_column($data_userinfos,'uid');
//        var_dump($uids);
        $rs = $this->mysql->where('fuid',$uid)->where('uid',$uids,'in')->update($this->table,['status'=>1,'add_time'=>time()]);
        if($rs){
            return $data_userinfos;
        }else{
            return false;
        }

    }

    /**
     * 获取申请好友列表
     * @param $uid
     * @return array
     */
    public function getFriendApply($uid)
    {
        $data = $this->mysql
            ->where('f.fuid',$uid)
            ->join('ckzc_role r',"f.fuid = r.uid",'LEFT')
            ->where('f.status',0,'<>')->get($this->table ." f",null,'r.uid,r.vip,r.nickname,r.icon,r.shenjiazhi,r.level,f.fuid,f.status,f.apply_time,r.shopid');
        return $data;
    }
}