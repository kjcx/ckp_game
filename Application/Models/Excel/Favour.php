<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午2:05
 */

namespace App\Models\Excel;
use App\Models\Model;
use think\Db;

/**
 * 好感度
 * Class Npc
 * @package App\Models\Excel
 */
class Favour extends Model
{
    public $table = 'ckzc.Excel_Favour';

    public function insert($arr)
    {
        Db::table($this->table)->insert($arr);
    }

    /**
     * 获取升级好感度所需道具
     * @param $NpcId
     * @param $Quality
     * @return array
     */
    public function getItem($NpcId,$Quality)
    {
        $data = Db::table($this->table)->where('NpcId',$NpcId)->where('Quality',$Quality)->find();
        if($data){
            $Item = $data['Item'];
            $arr = explode(';',$Item);
            $list = [];
            foreach ($arr as $item) {
                $res = explode(',',$item);
                $list[$res[0]] = $res[1];
            }
            $FriendValue = $data['FriendValue'];//友情值
            return ['FriendValue'=>$FriendValue,'ItemList'=>$list];
        }
    }
}