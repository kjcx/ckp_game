<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午8:53
 */
namespace App\Models\User;
use App\Models\BagInfo\Bag;
use App\Models\Excel\Character;
use App\Models\Model;
use App\Utility\Cache;
use MongoDB\BSON\ObjectId;

class Role extends Model
{
    private $table = 'ckzc_role';
    public $cache;
    public $RoleInfoKey = 'RoleInfo:uid:';
    public $RoleUserName = 'RoleUserName:_id:RoleUserName';
    public $Member = 'Member:_id:Member';
    public function __construct()
    {
        parent::__construct();
        $this->cache = Cache::getInstance();
    }

    /**
     * 获取角色信息
     * @param $Uid
     * @return array
     */
    public function getRole($Uid)
    {
        $key = $this->RoleInfoKey . $Uid;
        $arr = $this->cache->client()->hGetAll($key);
        return $arr;
//        $arr = $this->mysql->where("uid",$Uid)->getOne($this->table);
//        return $arr;
    }

    /**
     * 通过id获取角色信息
     * @param $Uid
     * @return array
     */
    public function getRoleById($Uid)
    {
        $key = $this->RoleInfoKey . $Uid;
        $arr = $this->redis->hGetAll($key);
        return $arr;
//        $arr = $this->mysql->where('id',$id)->getOne($this->table);
//        return $arr;
    }
    /**
     * 创建角色
     * @param $data
     * @return bool
     */
    public function createRole($uid,$nickname,$sex)
    {
        //1获取创建角色默认值
        $Character = new Character();
        $data = $Character->getInfoById((string)$sex);
        $icon = $data['Icon'];//头像
        $sign = $data['Desc'];//签名
        $level = $data['Level'];//等级
        $Avatar = $data['Avatar'];//装扮属性
        $data = [
            'uid'=>$uid,
            'nickname'=>$nickname,
            'sex'=>$sex,
            'status'=>1,
            'level'=>$level,//等级
            'exp'=>0,//经验值
            'shenjiazhi'=>0,//身价值
            'vip'=>0,//vip
            'sign'=>$sign,//签名
            'icon'=>$icon,//默认头像
            'create_time'=>time()
        ];
        $Avatars = explode(',',$Avatar);
        $UserAttr = new UserAttr();
        $rs = $UserAttr->setUserAttr($uid,$Avatars);
        var_dump("创建属性". $rs);
        //创建默认角色
        $info = $this->getRole($uid);
        if(!$info){
            $rs = $this->CreateRedisRole($data);
            if($rs!==false){
                $Bag = new Bag($uid);
                $res = $Bag->initBag();
                if($res){
                    return true;
                }else{
                    if($Bag->getBag()){
                        return true;
                    }else{
                        return false;
                    }
                }
            }

        }else{
            return true;
        }
    }

    /**
     * 创建背包数据
     */
    public function createRoleBag($data)
    {
        $RoleBag = new RoleBag();
        $rs = $RoleBag->createRoleBag($data);
        return $rs;
    }

    /**
     * 修改用户头像
     * @param $Uid 用户id
     * @param $icon 头像id
     * @return bool
     */
    public function updateIcon($Uid,$icon)
    {
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $rs = $this->cache->hashset($RoleInfoKey,'icon',$icon);
        return true;
//        $rs = $this->mysql->where('uid',$Uid)->update($this->table,['icon'=>$icon]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 修改昵称
     * @param $Uid
     * @param $nickname
     * @return bool
     */
    public function updateRoleName($Uid,$nickname)
    {

        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $rs = $this->cache->hashset($RoleInfoKey,'nickname',$nickname);

//        $rs = $this->mysql->where('uid',$Uid)->update($this->table,['nickname'=>$nickname]);
        if($rs!==faslse){
            //改名扣费
            $Bag = new Bag($Uid);
            $Bag->delBag(2,5000);
        }
        return $rs;
    }

    /**
     * 修改签名
     * @param $Uid
     * @param $Desc
     * @return bool
     */
    public function updateSignName($Uid,$Desc)
    {
        var_dump($Desc);
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $rs = $this->cache->hashset($RoleInfoKey,'sign',$Desc);
        var_dump($Desc);
        return true;
    }

    /**
     * 更新身价值
     * @param $Uid
     * @param $shenjia
     * @return bool
     */
    public function updateShenjiazhi($Uid,$shenjia)
    {
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $rs = $this->cache->hashHINCRBY($RoleInfoKey,'shenjiazhi',$shenjia);
        $value = $this->getShenjiazhi($Uid);
        updateRank($Uid,$value,1);//更新身价到队列
        return true;

    }

    /**
     * 验证角色名称是否存在
     * @param $nickname
     * @return bool
     */
    public function checkNickName($nickname)
    {
        $RoleUserName = $this->RoleUserName;
        $res = $this->cache->client()->hGet($RoleUserName,$nickname);
//        $res = $this->mysql->where('nickname',$nickname)->getOne($this->table);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 搜索玩家
     * @param $Name
     * @return array
     */
    public function SearchFriend($uid,$data)
    {
        $Name = $data['Name'];
        $Search  = $data['Search'];
        if($Search){//搜索
//            $data = $this->mysql->where('uid',$uid,'not in')->where('nickname',"%$Name%",'like')->get($this->table);
//            $data = $this->mysql->where('uid',$uid,'<>')->where('nickname',"%$Name%",'like')->get($this->table);
            $search_uid = $this->getRoleUserName($Name);
            if($search_uid){
                $data = $this->getRole($search_uid);
            }else{
                $data = [];
            }
            return [$data];
        }else{//推荐
            $Uids = $this->sRandMember(5);
            if(in_array($uid,$Uids)){
                $uid_new  = $this->sRandMember(1);
                $Uids[] = $uid_new[0];
            }
            $data = $this->getRoleByUids($Uids);
            var_dump($data);
            return $data;
        }
    }
    /**
     * 按用户昵称搜索
     * @param $UserName
     * @return string
     */
    public function getRoleUserName($UserName)
    {
        $RoleUserName = $this->RoleUserName;
        $Uid = $this->cache->client()->hGet($RoleUserName,$UserName);
        if ($Uid){
            return $Uid;
        }else{
            return '';
        }
    }
    /**
     * 获得金币
     * @param $uid
     * @return mixed
     */
    public  function getGold($uid)
    {
        $Bag = new Bag($uid);
        $data = $Bag->getBagByItemId(2);
        return $data['CurCount'];
    }

    /**
     * 获取用户等级
     * @param $uid 用户id
     * @return array
     */
    public function getLevel($Uid)
    {
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $data['level'] = $this->cache->client()->hGet($RoleInfoKey,'level');
        return $data;
        $data = $this->mysql->where('uid',$Uid)->getOne($this->table,'level');
        return $data;
    }

    /**
     * 随机获取用户
     * $param $IsFree 是否免费(待完善)
     */
    public function getListByRand($IsFree)
    {
        if($IsFree){
            $data = $this->sRandMember(5);
//            $data = $this->mysql->orderBy("RAND()")->get($this->table,5);
        }else{
            //获取之前生成的
//            $data = $this->mysql->orderBy("RAND()")->get($this->table,5);
            $data = $this->sRandMember(5);
        }
        return $data;
    }

    /**
     * 随机获取用户id
     * @param $count
     * @return array|string
     */
    public function sRandMember($count)
    {
        $Uids = $this->cache->client()->sRandMember($this->Member,$count);
        return $Uids;
    }
    /**
     * 通过id数组获取用户
     * @param $uids
     * @return bool
     */
    public function getRoleByUids($Uids)
    {
        if(empty($Uids)){
            return false;
        }else{
            foreach ($Uids as $uid) {
                $data[] = $this->getRole($uid);
            }
//            $data = $this->mysql->where('uid',$uids,'in')->get($this->table);
            if($data){
                return $data;
            }else{
                return false;
            }
        }

    }

    /**
     * 设置用户被雇佣店铺id
     * @param $MasterUiD
     * @param $Id
     * @return bool
     */
    public function setShopid($MasterUiD,$Id)
    {
        $RoleInfoKey = $this->RoleInfoKey;
        $rs = $this->cache->client()->hSet($RoleInfoKey,'shopid',$Id);
        return true;
//        $rs = $this->mysql->where('uid',$MasterUiD)->update($this->table,['shopid'=>$Id]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取身价值
     * @param $uid
     * @return mixed
     */
    public function getShenjiazhi($Uid)
    {
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $data['shenjiazhi'] = $this->cache->client()->hGet($RoleInfoKey,'shenjiazhi');
        return $data;
    }

    /**这些都是GM命令 高能 慎入**/
    /**
     *获取全部用户
     */
    public function getAllRole()
    {
        return $this->mysql->get($this->table);
    }

    /**
     * 更新等级
     * @param $uid
     * @param $level
     * @return bool
     */
    public function updateLevel($uid,$level)
    {
        $rs =  $this->mysql->where('uid',$uid)->update($this->table,['level' => $level]);
        return true;
    }

    /**
     * 更新等级
     * @param $Uid
     * @param $exp
     * @return bool
     */
    public function updateExp($Uid,$exp)
    {
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $this->cache->client()->hSet($RoleInfoKey,'exp',$exp);
        return true;
        return $this->mysql->where('uid',$Uid)->update($this->table,['exp' => $exp]);
    }

    /**这些都是GM命令 高能 慎入**/
    /**
     * 创建redis用户数据
     * @param $data
     * @return bool
     */
    public function CreateRedisRole($data)
    {
        $Uid = $data['uid'];
        $UserName = $data['nickname'];
        $RoleInfoKey = $this->RoleInfoKey . $Uid;
        $this->cache->hashSet($this->RoleUserName,$UserName,$Uid);
        $this->cache->setSadd($this->Member,$Uid);
        $rs = $this->cache->hashMset($RoleInfoKey,$data);
        return true;
        $rs = $this->mysql->insert($this->table,$data);

    }


}