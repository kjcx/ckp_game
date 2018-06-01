<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午8:53
 */
namespace App\Models\User;
use App\Models\BagInfo\Bag;
use App\Models\Execl\Character;
use App\Models\Model;

class Role extends Model
{
    private $table = 'ckzc_role';
    public function getRole($uid)
    {
        $arr = $this->mysql->where("uid",$uid)->getOne($this->table);
        return $arr;
    }

    /**
     * 通过id获取角色信息
     * @param $id
     * @return array
     */
    public function getRoleById($id)
    {
        $arr = $this->mysql->where('id',$id)->getOne($this->table);
        return $arr;
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
        $UserAttr->setUserAttr($uid,$Avatars);
        
        //后期事务
        //创建默认角色
        $rs = $this->mysql->insert($this->table,$data);
        if($rs){
//            $arr['rid'] = $rs;//角色id
//            $arr['uid'] = $data['uid'];//用户id
//            $arr['maxsum'] = 999;//背包最大数量
//            $arr['usesum'] = 0;//已使用
//            $arr['items'] = json_encode([]);//已获取道具数量
//            $res = $this->createRoleBag($arr);
            $Bag = new Bag($uid);
            $res = $Bag->initBag();
            if($res){
                return $rs;
            }else{
                return false;
            }
        }else{
            return false;
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
     * @param $uid 用户id
     * @param $icon 头像id
     * @return bool
     */
    public function updateIcon($uid,$icon)
    {
        $rs = $this->mysql->where('uid',$uid)->update($this->table,['icon'=>$icon]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 修改昵称
     * @param $uid
     * @param $nickname
     * @return bool
     */
    public function updateRoleName($uid,$nickname)
    {
        $rs = $this->mysql->where('uid',$uid)->update($this->table,['nickname'=>$nickname]);
        if($rs){
            //改名扣费
            $Bag = new Bag($uid);
            $Bag->delBag(2,5000);
        }
        return $rs;
    }

    public function updateShenjiazhi($uid,$shenjia)
    {
        $this->mysql->where('uid',$uid)->update($this->table,['shenjiazhi'=>$this->mysql->inc($shenjia)]);
    }

    /**
     * 验证角色名称是否存在
     * @param $nickname
     * @return bool
     */
    public function checkNickName($nickname)
    {
        $res = $this->mysql->where('nickname',$nickname)->getOne($this->table);
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
            $data = $this->mysql->where('uid',$uid,'<>')->where('nickname',"%$Name%",'like')->get($this->table);
        }else{//推荐
            $data = $this->mysql->where('uid',$uid,'<>')->get($this->table,5);
        }
        return $data;
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
    public function getLevel($uid)
    {
        $data = $this->mysql->where('uid',$uid)->getOne($this->table,'level');
        return $data;
    }

    /**
     * 随机获取用户
     * $param $IsFree 是否免费
     */
    public function getListByRand($IsFree)
    {
        if($IsFree){
            $data = $this->mysql->orderBy("RAND()")->get($this->table,5);
        }else{
            //获取之前生成的
            $data = $this->mysql->orderBy("RAND()")->get($this->table,5);
        }
        return $data;
    }

    /**
     * 通过id数组获取用户
     * @param $uids
     * @return bool
     */
    public function getRoleByUids($uids)
    {
        if(empty($uids)){
            return false;
        }else{
            $data = $this->mysql->where('uid',$uids,'in')->get($this->table);
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
        $rs = $this->mysql->where('uid',$MasterUiD)->update($this->table,['shopid'=>$Id]);
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
    public function getShenjiazhi($uid)
    {
        $info = $this->getRole($uid);
        return $info['shenjiazhi'];
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
     */
    public function updateLevel($uid,$level)
    {
        return $this->mysql->where('uid',$uid)->update($this->table,['level' => $level]);
    }

    /**
     * 更新等级
     * @param $uid
     * @param $exp
     * @return bool
     */
    public function updateExp($uid,$exp)
    {
        return $this->mysql->where('uid',$uid)->update($this->table,['exp' => $exp]);
    }

    /**这些都是GM命令 高能 慎入**/
}