<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午5:22
 */
namespace App\Models\User;

use App\Models\Excel\Item;
use App\Models\Model;
use App\Utility\Cache;

/**
 * 用户属性
 * Class UserAttr
 * @package App\Protobuf\User
 */
class UserAttr extends Model
{

    private $table = 'ckzc_userattr';
    public $UserAttr = 'UserAttr:Uid:';
    public $cache;
    public function __construct()
    {
        parent::__construct();
        $this->cache = Cache::getInstance();
    }

    public  function setUserAttr($Uid,$ids)
    {

        foreach ($ids as $id) {
            $ids[] = (int)$id;
        }
        $bool = true;
        $data_user_attr_id = $this->getUserAttrId($Uid);
        if(!$data_user_attr_id){
            $bool = false;
            $data_user_attr_id = [];
        }
        //判断道具部位
        $item = new Item();
        $data_item = $item->getItemIds($ids);
        $now_Status = 0;//现在就时装身价值
        //根据Parts 判断部位
        foreach ($data_item as $v) {
            $type = $this->Parts($v['Parts']);
            var_dump($v['Parts'] . '===' .$v['Id'].'==>'. $type);
            $data_user_attr_id[$type] = $v['Id'];

        }
        $key = $this->UserAttr . $Uid;
        $arr = $this->cache->hashMset($key,$data_user_attr_id);
        return $arr;
        $data['uid'] = $Uid;
        $data['user_attr_id'] = json_encode($data_user_attr_id);
        $data['update_time'] = time();
        $data['status'] = 1;
        if($bool){
            $rs = $this->mysql->where('uid',$Uid)->update($this->table,$data);
            return true;
        }else{
            return $this->mysql->insert($this->table,$data);
            echo("sadfasdfa");
        }
    }

    /**
     * 获取用户属性
     * @param $uid
     * @return array
     */
    public function getUserAttr($Uid)
    {
        $key = $this->UserAttr . $Uid;
        $arr = $this->redis->hGetAll($key);
        return $arr;
    }

    /**
     * 获取属性id
     * @param $Uid
     * @return mixed
     */
    public function getUserAttrId($Uid)
    {
        $key = $this->UserAttr . $Uid;
        $arr = $this->redis->hGetAll($key);
        return $arr;
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