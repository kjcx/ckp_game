<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 下午12:12
 */

namespace App\Models\Sign;


use App\Models\Model;
use think\Db;

class SignInfo extends Model
{
    public $table = 'ckzc.SignInfo';
    public $key  = 'Sign:';
    /**
     * 创建每月信息
     */
    public function create($Uid)
    {
        $data['Uid'] = $Uid;
        $num = date('t',time());
        $value = [];
        for ($i=1;$i<=$num;$i++){
            $value[$i]['IsSign'] = false;
//            $value[$i]['Day'] = $i;
        }
        $month = date('M',time());
        $data['Info'][$month] = $value;

        $rs = Db::table($this->table)->insert($data);
        if($rs){
            $rs = $this->setRedisSignInit($Uid);
            return $rs;
        }else{
            var_dump("创建失败");
        }
    }

    /**
     * 初始化用户信息
     * @param $Uid
     * @return bool
     */
    public function setRedisSignInit($Uid)
    {
        $key = $this->key . $Uid;
        $num = date('t',time());
        $ttl = date('t',time()) * 86400 + strtotime(date('Y-M-1',time()));
        $value = [];
        $month = date('M',time());
        for ($i=1;$i<=$num;$i++){
            $value['IsSign'] = false;
            $hashKey = $month . ':' . $i;
            $rs = $this->redis->hSet($this->key.$Uid,$hashKey,json_encode($value));
        }

        return $rs;
    }

    /**
     * @param $Uid
     * @return mixed
     */
    public function getRedisSign($Uid)
    {
        $arr = $this->redis->setBit($this->key.$Uid.':'.date("Y-m",time()),date('d',time()),1);
        return;
        $rs =  $this->checkSignKey($Uid);
        if(!$rs){
            $rs = $this->create($Uid);
        }
        $month = date('M',time());
        $hashkey = $month . "*";
        $arr = $this->redis->setBit($this->key.$Uid.':'.date("Y-m",time()),date('d',time()));
        var_dump($arr);
        return $arr;
    }

    /**
     * 检查签收数据是否存在
     * @param $Uid
     * @return bool
     */
    public function checkSignKey($Uid)
    {
        $rs = $this->redis->exists($this->key . $Uid);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    public function getSign($Uid)
    {
        $Month = date('m',time());
        $Day = date('d',time());
        $value = $this->redis->get($this->key . $Uid . $Month);
        $bitmap = unpack('C*', $value);
        var_dump($bitmap);
    }

    public function setSign($Uid)
    {
        $Month = date('m',time());
        $Day = date('d',time());
        $arr = $this->redis->setBit($this->key . $Uid . $Month,$Day,1);
    }
    public function getSignCount()
    {
        
    }

    /**
     * 获取本月签到数据
     * @param $Uid
     */
    public function getSignMonthCount($Uid)
    {
        $month = ':' . date('m',time());
        $num = $this->redis->bitCount($this->key . $Uid . $month);
        var_dump($num);
        var_dump($num);
    }

    /**
     * 检查是否签到
     * @param $Uid
     * @param $Day
     */
    public function checkIsSign($Uid,$Day)
    {
        $key = $this->key . 'Uid:' . date('m');
        $this->redis->getBit($key,$Day);
    }


}