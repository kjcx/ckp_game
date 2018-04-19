<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午5:22
 */
namespace App\Models\User;
use App\Models\BagInfo\Item;
use App\Models\Model;

/**
 * 用户属性
 * Class UserAttr
 * @package App\Protobuf\User
 */
class UserAttr extends Model
{
    private $table = 'ckzc_userattr';
    public  function setUserAttr($uid,$ids)
    {
        foreach ($ids as $id) {
            $ids[] = (int)$id;
        }
        $bool = true;
        $data_user_attr_id = $this->getUserAttrId($uid);
        if(!$data_user_attr_id){
            $bool = false;
            $data_user_attr_id = [];
        }
        //判断道具部位
        $item = new Item();
        $data_item = $item->getItemByIds($ids);
        var_dump($data_item);
        //根据Parts 判断部位
        foreach ($data_item as $v) {
            $type = $this->Parts($v['Parts']);
            var_dump($v['Parts'] . '===' .$v['Id'].'==>'. $type);
            $data_user_attr_id[$type] = $v['Id'];
        }
//        var_dump($data_user_attr_id);
        $data['uid'] = $uid;
        $data['user_attr_id'] = json_encode($data_user_attr_id);
//        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['status'] = 1;
        if($bool){
            return $this->mysql->where('uid',$uid)->update($this->table,$data);
        }else{
            return $this->mysql->insert($this->table,$data);
        }
    }

    /**
     * 获取用户属性
     * @param $uid
     * @return array
     */
    public function getUserAttr($uid)
    {
        $data = $this->mysql->where('uid',$uid)->getOne($this->table);

        return $data;
    }

    /**
     * 获取属性id
     * @param $uid
     * @return mixed
     */
    public function getUserAttrId($uid)
    {
        $data = $this->getUserAttr($uid);
        $user_attr_id = json_decode($data['user_attr_id'],1);
        return $user_attr_id;
    }

    /** 处理部位
     * @param $Parts
     * @return string
     */
    public function Parts($Parts)
    {
        $arr['1'] = 'Head';
        $arr['2'] = 'Body';
        $arr['3'] = 'Pants';
        $arr['4'] = 'Parts';
        if(stripos(',',$Parts)){
            //
            return $arr['2'];
        }else{
            return $arr[$Parts];
        }
    }
}