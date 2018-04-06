<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 上午12:36
 */
namespace App\Models\User;
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
            foreach ($arr as $k => $v) {
                if($v['id'] == $bag_data['id']){
                    //道具id存在 ➕1
                    if($v['CurCount'] < 999){
                        $v['CurCount'] += 1;
                    }else{
                        $v['OnSpace'] += 1;
                        $v['CurCount'] += 1;
                    }
                }else{
                    $v['CurCount'] = 1;
                    $v['OnSpace'] = 1;
                    $v['id'] = $bag_data['id'];
                }
                $arr[$bag_data['id']] = $v;
            }
        }else{
            $arr[$bag_data['id']] = ['id'=>$bag_data['id'],'CurCount'=>1,'OnSpace'=>1];
        }
        $rs = $this->mysql->where("uid",$uid)->update($this->table,['items'=>json_encode($arr)]);
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

}