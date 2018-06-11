<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 下午1:35
 */

namespace App\Models\Mail;


use App\Models\Model;
use think\Db;

/**
 * 邮件消息
 * Class MailMsg
 * @package App\Models\Mail
 */
class MailMsg extends Model
{
    public $table = 'ckzc.Mail';
    public $Mail = 'Mail:';
    public $MailList = 'MailList:';
    public $expiry = 7 * 86400;

    /**
     * 创建邮件消息
     * @param $data
     * @return bool
     */
    public function createMailMsg($data)
    {
        $data['Read'] = false;
        $data['Reward'] = false;
        $data['SendTime'] = time();
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            $Id =  Db::table($this->table)->getLastInsID();
            $data['_id'] = $Id;
            $this->setRedisMail($data['Uid'],$data);
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取所有邮件
     * @param $Uid
     * @return array
     */
    public function getRedisMailByUid($Uid)
    {
        $key = $this->MailList . $Uid;
        $data = $this->redis->HGETALL($key);
        $list = [];
        foreach ($data as $datum =>$value) {
            $bool = $this->redis->exists($datum);
            if($bool){
                $list[] = json_decode($value,true);
            }else{
                $this->redis->hDel($key,$datum);
            }
        }
        return $list;
    }

    /**
     * 设置redis数据
     * @param $Uid
     * @param $data
     * @return bool
     */
    public function setRedisMail($Uid,$data)
    {
        $key  = $this->Mail . (string)$data['_id'];
        $this->redis->setex($key,$this->expiry,json_encode($data));
        $this->redis->hSet('MailList:36',$key,json_encode($data));
        return true;

        $data['Read'] = false;
        $data['Reward'] = false;
        $data['Title'] = 'Title';
        $data['Item'] = [10001=>2];
        $data['SenderIcon'] = '0001';
        $data['SenderName'] = 'admin';
        $data['Msg'] = 'ceshi';
        $data['SendTime'] = time();
        $data['SenderId'] = 1;
        $data['Id'] = '1';
        $this->redis->setex($key,10,json_encode($data));
        $this->redis->hSet('MailList:36',$key,json_encode($data));
    }
}