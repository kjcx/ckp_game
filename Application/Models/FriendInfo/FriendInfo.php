<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/5
 * Time: 下午6:31
 */

namespace App\Models\FriendInfo;


use App\Models\Model;
use App\Models\User\Role;

class FriendInfo extends Model
{
    public $key = 'FriendInfo:';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 获取用户好友
     * @param $Uid
     * @return mixed
     */
    public function getRedisFriend($Uid)
    {
        $key = $this->key . $Uid;
        $arr = $this->redis->hGetAll($key);
        return $arr;
    }

    /**
     * 设置好友信息
     * @param $Uid
     * @param $Fuids 好友id
     * @return int
     */
    public function setRedisFriend($Uid,$Fuids)
    {
        $key = $this->key . $Uid;
        foreach ($Fuids as $fuid) {
            $rs = $this->redis->hSet($key,$fuid,serialize(['Uid'=>$fuid,'FriendStatus'=>3,'ApplyTime'=>time()]));
            $rs = $this->redis->hSet($this->key.$fuid,$Uid,serialize(['Uid'=>$Uid,'FriendStatus'=>3,'ApplyTime'=>time()]));
        }
        return $rs;
    }

    /**
     * 设置好友通过
     * @param $Uid
     * @param $data
     * @return bool|int
     */
    public function setRedispassFriend($Uid,$data)
    {
        $key = $this->key . $Uid;
//        var_dump($data);
        $rs = $this->redis->hSet($key,$data['Uid'],serialize($data));
        return $rs;
    }

    /**
     * 验证是不是好友
     * @param $uid
     * @param $Fuid
     * @return string
     */
    public function checkIsFriend($Uid,$Fuid)
    {
        $key = $this->key . $Uid;
        $str = $this->redis->hGet($key,$Fuid);
        if($str){
            $arr = unserialize($str);
            if($arr['FriendStatus'] ==1){
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * 获取好友详细信息
     * @param $Uid
     * @return bool
     */
    public function getFriendInfoByUid($Uid)
    {
        $key = $this->key . $Uid;
        $data_Friend = $this->getRedisFriend($Uid);
        $Uids = $this->getFriendUid($Uid);
        $Role = new Role();
        if($Uids){
            $data_role = $Role->getRoleByUids($Uids);
            if($data_role){
                foreach ($data_role as &$item) {
                    $arr = unserialize($data_Friend[$item['uid']]);
                    $item['FriendStatus'] = $arr['FriendStatus'];
                    $item['ApplyTime'] = $arr['ApplyTime'];
                    if(isset($arr['AddTime'])){
                        $item['AddTime'] = $arr['AddTime'];
                    }else{
                        $item['AddTime'] = 0;
                    }

                }
            }
            return $data_role;
        }else{
            return false;
        }
    }

    /**
     * 获取用户所有好友的uid
     * @param $Uid
     * @return array
     */
    public function getFriendUid($Uid)
    {
        $key = $this->key . $Uid;
        //获取所有已经是好友的uid
        $data = $this->redis->hGetAll($key);
        $Uids = [];
        foreach ($data as $uid => $datum) {
            $arr = unserialize($datum);
            if($arr['FriendStatus'] == 1){
                $Uids[] = $uid;
            }
        }
//        $data = $this->redis->hKeys($key);
        return $Uids;
    }

    /**
     * 通过好友申请
     * @param $Uid
     * @param $Fuids //通过的好友集合
     * 好友状态    FriendStatus
     * 非好友    None    0
     * 好友    Friend    1
     * 正在向其申请好友    ApplyTo    2
     * 正在向我申请好友    ApplyFrom    3
     * @return bool
     */
    public function passFriendApply($Uid,$Fuids)
    {
        $rs = true;
        $data = $this->getRedisFriend($Uid);

        foreach ($Fuids as $fuid) {
            $arr = unserialize($data[$fuid]);
            $arr['FriendStatus'] = 1;
            $arr['AddTime'] = time();//通过时间
            $bool = $this->setRedispassFriend($Uid,$arr);
            $arr['Uid'] = $Uid;//2个人状态
            $bool = $this->setRedispassFriend($fuid,$arr);
//            var_dump($bool);
//            if($bool === 0){
//                var_dump("redis设置错误");
//                $rs = false;
//                return;
//            }
        }
        return $rs;
    }

    /**
     * 获取通过好友信息
     * @param $Uid
     * @param $Fuids
     * @return bool
     */
    public function getFriendInfoByFuids($Uid,$Fuids)
    {
        $data_Friend = $this->getFriendUid($Uid);//自己所有好友
        $info = $this->getRedisFriend($Uid);
        $Role = new Role();
        $data = $Role->getRoleByUids($data_Friend);
//        var_dump($data);
        foreach ($data as &$datum) {
            $arr = unserialize($info[$datum['uid']]);
//            var_dump($arr);
            $datum['FriendStatus'] = $arr['FriendStatus'];
            $item['AddTime'] = time();
            $item['ApplyTime'] = $arr['ApplyTime'];
        }
        return $data;
    }

    /**
     * 获取自己与好友的状态
     * @param $Uid
     * @param $Fuids
     * @return array|mixed
     */
    public function getFriendStatus($Uid,$Fuids)
    {
        $arr_friend = [];
        $data = $this->getRedisFriend($Uid);
        $Role = new Role();
        $data_role = $Role->getRole($Uid);
//        var_dump($data_role);
        foreach ($Fuids as $fuid) {
            $arr = [];
            $data_role_new = $data_role;
            $str = $data[$fuid];
            $arr = unserialize($str);
            $data_role_new['FriendStatus'] = $arr['FriendStatus'];
            $data_role_new['ApplyTime'] = $arr['ApplyTime'];
            if(isset($arr['AddTime'])) {
                $data_role_new['AddTime'] = $arr['AddTime'];
            }else{
                $data_role_new['AddTime'] = 0;
            }
            $data_role_new['fuid'] = $fuid;
//            var_dump($data_role_new);
            $arr_friend[] = $data_role_new;
        }
        return $arr_friend;
    }

    /**
     * 拒绝申请
     * @param $Uid
     * @param $Fuids
     * @return bool
     */
    public function setRefuseFriend($Uid,$Fuids)
    {
        $rs = true;
        $data = $this->getRedisFriend($Uid);

        foreach ($Fuids as $fuid) {
            $arr = unserialize($data[$fuid]);
            $arr['FriendStatus'] = 4;//拒绝
            $arr['AddTime'] = time();//通过时间
            $bool = $this->setRedispassFriend($Uid,$arr);
            $arr['Uid'] = $Uid;//2个人状态
            $bool = $this->setRedispassFriend($fuid,$arr);
        }
        return $rs;
    }

    /**
     * 删除好友
     * @param $Uid
     * @param $Fuid
     * @return bool
     */
    public function setRemoveFriend($Uid,$Fuid)
    {
        $key = $this->key . $Uid;
        $this->redis->hDel($key,$Fuid);
        $this->redis->hDel($this->key . $Fuid ,$Uid);
        return true;

    }

    /**
     * 搜索好友
     * @param $Uid
     * @param $data
     * @return array
     */
    public function SearchFriend($Uid,$data)
    {
        $uids = $this->getFriendUid($Uid);

        $uids[] = $Uid;
        $Role = new Role();
        $Name = $data['Name'];
        $Search  = $data['Search'];
        $data = $Role->SearchFriend($Uid,$data);
//        var_dump($data);
        return $data;
    }

    /**
     * 设置黑名单 状态5
     * @param $Uid
     * @param $Fuid
     * @return bool|int
     */
    public function setBlackFriend($Uid,$Fuid)
    {
        $key = $this->key . $Uid;
        $arr = ['Uid'=>$Fuid,'FriendStatus'=>5,'ApplyTime'=>time()];
        $rs = $this->redis->hSet($key,$Fuid,serialize($arr));
        return $rs;
    }

    /**
     * 获取好友状态下的uid
     * @param int $Uid
     * @param int $Status
     * @return array
     */
    public function getUidByFriendStatus($Uid,$Status=3)
    {
        $data_Friend = $this->getRedisFriend($Uid);

        $Uids = [];
        foreach ($data_Friend as $item) {
            $arr = unserialize($item);
            if($arr['FriendStatus'] == $Status){
                $Uids[] = $arr['Uid'];
            }
        }
        return $Uids;
    }

    /**
     * 获取2个人之间的好友关系
     * @param $Uid
     * @param $Fuid
     * @return int
     */
    public function getFriendStatusByFuid($Uid,$Fuid)
    {
        $key = $this->key . $Uid;
        $str = $this->redis->hGet($key,$Fuid);
        if($str){
            $arr = unserialize($str);
            return $arr['FriendStatus'];
        }else{
            return 0;
        }

    }
}