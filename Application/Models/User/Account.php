<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 上午11:08
 */
namespace App\Models\User;
use App\Models\Model;
use EasySwoole\Config;
use GuzzleHttp\Client;

class Account extends Model
{
    private $table = 'ckzc_member';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 单独查询
     * @param $where
     * @return array
     */
    function find($where)
    {
        $arr = $this->mysql->where($where)->getOne($this->table);
        return $arr;
    }

    /**
     * 插入数据
     * @param $member_info
     * @return mixed
     */
    function insert($data)
    {
        $id = $this->mysql->insert($this->table, $data);
        return $id;
    }

    /**
     * 修改用户信息
     * @param $where
     * @param $data
     * @return mixed
     */
    function update($where,$data)
    {
        $result = $this->mysql->where($where)->update($this->table,$data);
        if ($this->mysql->getLastErrno() === 0)
            return true;
        else{
            echo 'Update failed. Error: '. $this->mysql->getLastError();
            return false;
        }
    }

    /**
     * 根据用户id创建token
     * @param $uid
     * @return bool|string
     */
    public function crateToken($uid)
    {
        $token = md5($uid . rand(10000,99999) . rand(10000,99999). microtime() );
        //插入到
         $rs = $this->redis->set($token,$uid);
         if($rs){
             return $token;
         }else{
             return false;
         }
    }

    /**
     * 获取token
     * @param $token
     * @return bool
     */
    public function getToken($token)
    {
        $rs = $this->redis->get($token);
        if($rs){
            return $rs;
        }else{
            return false;
        }
    }

    /**
     * 通过app充值
     * @param $uid
     * @param $money
     * @param $pwd
     * @param string $type
     */
    public function payByApp($uid,$money,$pwd,$type='game_recharge')
    {
        //1 支付密码,2余额，
        $pay_app = Config::getInstance()->getConf('APP.pay_app');
        var_dump($pay_app);
        $key = '1';
        $url = $pay_app ;
        $client = new Client();
        $postdata = [
            'key'=>$key,
            'money'=>$money,
            'lg_source_only'=>date('YmdHis').rand(0000,9999),
            'log_type'=>$type,
            'member_paypwd'=>$pwd
            ];
        $res = $client->request('POST',$url,['form_params'=>$postdata]);

        $str = $res->getBody()->getContents();
        $arr = json_decode($str,1);
        return $arr;

    }

}