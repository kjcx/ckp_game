<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/1
 * Time: 下午1:40
 */

namespace App\Models\FruitsData;


use App\Models\Model;
use think\Db;

class FruitsData extends Model
{
    public $table = 'ckzc.FruitsData';

    public function create($data)
    {
        $Uid = $data['Uid'];
        $key = 'FruitsData' . $Uid;
        if($this->redis->get($key)){
            //key存在
        }else{
            $arr[1] = 3001;
            $arr[2] = 3002;
            $arr[3] = 3003;
            $arr[4] = 3004;
            $arr[5] = 3005;
            $arr[6] = 3006;
            $arr[7] = 3007;
            $arr[8] = 3008;
            $arr[9] = 3009;
            $arr[10] = 3010;
            $arr[11] = 3011;
            $arr[12] = 3012;

            $value =
            $ttl = strtotimr(date('Y-m-d',strtotime("+1 day"))) - time();//过期时间
            $this->redis->setex($key,$ttl,$value);
        }

    }
    //每个人 每天生成 水果机数据

}