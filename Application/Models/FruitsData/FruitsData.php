<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/1
 * Time: 下午1:40
 */

namespace App\Models\FruitsData;


use App\Models\Excel\Drop;
use App\Models\Excel\Fruits;
use App\Models\Model;
use think\Db;

class FruitsData extends Model
{
    public $table = 'ckzc.FruitsData';

    public function create($data)
    {


    }
    //每个人 每天生成 水果机数据
    public function getFruitsData($data)
    {
        $Uid = $data['Uid'];
        $key = 'FruitsData:' . $Uid;
        $Weight_key = 'FruitsDataWeight:' . $Uid;
        $FruitsData = $this->getRedisFruitsData($Uid);
        if($FruitsData){
            //key存在
            $arr = $FruitsData;
        }else{
            $Fruits = new Fruits();
            $data_Fruits = $Fruits->getAll();//水果机配置
//            var_dump($data_Fruits);
            $Drop = new Drop();
            foreach ($data_Fruits as $data_Fruit) {
                $Weight = $data_Fruit['Weight'];//12个商品 每个商品的权重
                $FruitsId = $data_Fruit['Id'];//// 位置id
                $DropId = $data_Fruit['DropId'];//掉落库id
                $data_drop = $Drop->getInfoById($DropId);
//                var_dump($data_drop);
                $DropLibs = explode(';',$data_drop['DropLib']);
//                var_dump($DropLibs);
                foreach ($DropLibs as $dropLib) {
                    $res = explode(',',$dropLib);
                    $itemid = $res[0];//道具id
                    $min = $res[1];//最小值
                    $max = $res[2];//最大值
                    mt_srand();
                    $count = rand($min,$max);
                    $quanzhong = $res[3];//权重
                    $suiji[$FruitsId][] = ['Weight'=>$Weight,'ItemId'=>(int)$itemid,'Count'=>$count,'quanzhong'=>$res[3],'Status'=>false,'FruitsId'=>$FruitsId];
                }
                for ($j=0;$j<$Weight;$j++){
                    $array_Weight[] = $FruitsId;
                }
//                var_dump($suiji);
            }
            foreach ($suiji as $k=>$item) {
                if(count($item) != 1){
                    foreach ($item as $key=> $v) {
                        $rand = [];
                        for($i=0;$i<$v['quanzhong'];$i++){
                            $rand[] = $key;
                        }
                        //随机取一个
                        mt_srand();
                        $new_item = $item[array_rand($rand)];//多个随机一个
                    }

                }else{
                    $new_item = $item[0];
                }
                $arr[$k] = $new_item;
            }
//            $arr[1] = ['ItemId'=>10004,'Count'=>1,'Status'=>false,'FruitsId'=>1];
//            $arr[2] = ['ItemId'=>101,'Count'=>2,'Status'=>false,'FruitsId'=>2];
//            $arr[3] = ['ItemId'=>101,'Count'=>3,'Status'=>false,'FruitsId'=>3];
//            $arr[4] = ['ItemId'=>131,'Count'=>4,'Status'=>false,'FruitsId'=>4];
//            $arr[5] = ['ItemId'=>10006,'Count'=>1,'Status'=>false,'FruitsId'=>5];
//            $arr[6] = ['ItemId'=>121,'Count'=>1,'Status'=>false,'FruitsId'=>6];
//            $arr[7] = ['ItemId'=>141,'Count'=>1,'Status'=>false,'FruitsId'=>7];
//            $arr[8] = ['ItemId'=>10007,'Count'=>1,'Status'=>false,'FruitsId'=>8];
//            $arr[9] = ['ItemId'=>10008,'Count'=>1,'Status'=>false,'FruitsId'=>9];
//            $arr[10] = ['ItemId'=>10002,'Count'=>1,'Status'=>false,'FruitsId'=>10];
//            $arr[11] = ['ItemId'=>101,'Count'=>1,'Status'=>false,'FruitsId'=>11];
//            $arr[12] = ['ItemId'=>10003,'Count'=>1,'Status'=>false,'FruitsId'=>12];

//            $value = serialize($arr);
//            $ttl = strtotime(date('Y-m-d',strtotime("+1 day"))) - time();//过期时间
            $this->setRedisFruitsData($Uid,$arr);
//            $this->redis->setex($Weight_key,$ttl,serialize($array_Weight));//权重
            $this->setRedisWeight($Uid,$array_Weight);
        }
        return $arr;
    }

    /**
     * 修改水果机中奖数据
     * @param $Uid
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateFruitsData($Uid,$id)
    {
        $new_arr = $this->getRedisFruitsData($Uid);
        $new_arr[$id]['Status'] = true;
        $rs = $this->setRedisFruitsData($Uid,$new_arr);
        return $rs;
    }

    /**
     * 获取当前用户权重
     * @param $Uid
     * @return mixed
     */
    public function getRedisWeight($Uid)
    {
        $key = 'FruitsDataWeight:' . $Uid;
        $str = $this->redis->get($key);
        $arr = unserialize($str);
        return json_decode($arr,true);
    }

    /**
     * 获取中奖格子
     * @param $Uid
     */
    public function getFruitsId($Uid)
    {
        $Weight = $this->getRedisWeight($Uid);
        $FruitsId = $Weight[array_rand($Weight)];
        if($FruitsId){
            //删除数组中$FruitsId
            foreach ($Weight as &$item) {

                if($item != $FruitsId){
                    $new[] = $item;
                }
            }
            $this->setRedisWeight($Uid,$new);
        }
        return $FruitsId;
    }

    /**
     * 设置用户权重
     * @param $Uid
     * @param $arr
     * @return bool
     */
    public function setRedisWeight($Uid,$arr)
    {
        $Weight_key = 'FruitsDataWeight:' . $Uid;
        $ttl = strtotime(date('Y-m-d',strtotime("+1 day"))) - time();//过期时间
        $rs = $this->redis->setex($Weight_key,$ttl,serialize(json_encode($arr)));//权重
        return $rs;
    }

    /**
     * 设置水果机数据
     * @param $Uid
     * @param $arr
     * @return bool
     */
    public function setRedisFruitsData($Uid,$arr)
    {
        $key = 'FruitsData:' . $Uid;
        $ttl = strtotime(date('Y-m-d',strtotime("+1 day"))) - time();//过期时间
        $rs = $this->redis->setex($key,$ttl,serialize(json_encode($arr)));//权重
        return $rs;
    }

    /**
     * 获取水果机数据
     * @param $Uid
     * @return mixed
     */
    public function getRedisFruitsData($Uid)
    {
        $key = 'FruitsData:' . $Uid;
        $str = $this->redis->get($key);
        $arr = unserialize($str);
        return json_decode($arr,true);
    }
}