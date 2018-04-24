<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 上午12:36
 */
namespace App\Models\User;
use App\Event\UserEvent;
use App\Models\Model;

class RoleBag extends Model
{
    private $table = 'ckzc_bag';
    public  function getRoleBag($uid)
    {
        $data = $this->mysql->where("uid",$uid)->getOne($this->table);
        return $data;
    }

    /**
     * 创建默认背包信息
     * @param $data
     * @return bool
     */
    public function createRoleBag($data)
    {
        $rs = $this->mysql->insert($this->table,$data);
        return $rs;
    }

    /**
     * 修改背包信息
     * @param $uid
     * @param $bag_data 道具信息
     * @return bool
     */
    public function updateRoleBag($uid,$bag_data)
    {
        $data = $this->getRoleBag($uid);
        $arr = json_decode($data['items'],1);
        if(count($arr)>0){
            if(isset($arr[$bag_data['id']])){
                //判断道具是否存在
                $arr[$bag_data['id']]['CurCount'] += $bag_data['CurCount'];
            }else{
                $arr[$bag_data['id']] = ['id'=>$bag_data['id'],'OnSpace'=>1,'CurCount'=>$bag_data['CurCount']];
            }
//            foreach ($arr as $k => $v) {
//                if($v['id'] == $bag_data['id']){
//                    echo '1111111';
//                    //道具id存在 ➕1
//                    if($v['CurCount'] < 999){//判断需要重写
//                        $v['CurCount'] += $bag_data['Count'];
//                    }else{
//                        $v['OnSpace'] += 1;
//                        $v['CurCount'] += $bag_data['Count'];
//                    }
//                }else{
//                    echo '222222';
//                    $v['CurCount'] = $bag_data['Count'];
//                    $v['OnSpace'] = 1;
//                    $v['id'] = $bag_data['id'];
//                }
//                $arr[$bag_data['id']] = $v;
//            }
        }else{
            $arr[$bag_data['id']] = ['id'=>$bag_data['id'],'CurCount'=>$bag_data['CurCount'],'OnSpace'=>1];
        }
        $rs = $this->mysql->where("uid",$uid)->update($this->table,['items'=>json_encode($arr)]);
        if($rs){
            //测试 $bag_data['id'] == 2
            if($bag_data['id'] == 2){
                //通知金币变化
                $UserEvent = new UserEvent($uid);
                $UserEvent->GoldChangedResultEvent();
            }
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 获取用户金币
     * @param $uid 用户id
     * @param $item_id 道具id
     * @return mixed
     */
    public function getUserGoldByUid($uid,$item_id)
    {
        $arr = $this->getRoleBag($uid);
        $item = $arr['items'];
        $data = json_decode($item,1);
        return  $data[$item_id]['CurCount'];
    }

    /**
     * 获取指定道具的数量
     * @param $uid
     * @param $ids
     * @return array
     */
    public function getItemByIds($uid,$ids)
    {
        $arr = $this->getRoleBag($uid);
        $item = $arr['items'];
        $data = json_decode($item,1);
        $update_item = [];
        foreach ($ids as $id) {
            $update_item[$id] = $data[$id]['CurCount'];
        }
        return $update_item;
    }


}