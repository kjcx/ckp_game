<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 上午11:08
 */
namespace App\Models\User;
use App\Models\BagInfo\Bag;
use App\Models\Log\Pay;
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
         $rs = $this->redis->setex($token,600,$uid);
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
        $key = $this->getAppTokenByUid($uid);
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
        $Pay = new Pay();
        $postdata['Status'] = 0;
        $postdata['CreateTime'] = date('Y-m-d H:i:s',time());
        $postdata['Uid'] = $uid;
        $Pay->create($postdata);
        $str = $res->getBody()->getContents();
        $arr = json_decode($str,1);
        if($arr['code'] == 200){
            //充值成功更改充值订单状态
            $UpdateTime = date('Y-m-d H:i:s',time());
            $Pay->changeOrderStatus($postdata['lg_source_only'],['Status'=>1,'UpdateTime'=>$UpdateTime]);
        }
        return $arr;

    }

    /**
     * 通过uid 获取用户apptoken
     * @param $uid
     * @return bool
     */
    public function getAppTokenByUid($uid)
    {
        $data = $this->mysql->where('id',$uid)->getOne($this->table);
        if($data['app_token']){
            return $data['app_token'];
        }else{
            return false;
        }
    }

    public function Change_Ckb_Gold($uid,$data)
    {
        //1. 兑换类型判断
        if($data['ChangeTo'] == 1){
            //金币兑换创客币
            $itmeid = 2;
        }elseif ($data['ChangeTo'] == 2){
            //创客派兑换金币
            $itmeid = 3;
        }else{
            $itmeid = '';
        }
        //2.兑换数量验证
        $count = $data['Count'];
        $Bag = new Bag($uid);
        $user_count = $Bag->getCountByItemId($itmeid);
        if($user_count >= $count){
            //执行兑换
            $Bag = new Bag($uid);

        }else{
            //数量不足兑换不了
        }
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $data = $this->mysql->join('ckzc_role r',"r.uid = m.id",'LEFT')->orderBy('app_token','asc')->get($this->table ." m",null,'r.uid,m.app_token,m.id,r.nickname');
        return $data;
    }

    /**
     * 验证token是否存在
     */
    public function check_app_token($app_token)
    {
        $data = $this->mysql->where('app_token',$app_token)->getOne($this->table);
        return $data;
    }

    /**
     * 获取最大apptoken
     */
    public function get_app_token()
    {
        $data = $this->mysql->orderBy('app_token','DESC')->getOne($this->table);
        return $data['app_token'];
    }

}