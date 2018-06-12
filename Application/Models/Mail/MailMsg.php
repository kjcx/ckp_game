<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 下午1:35
 */

namespace App\Models\Mail;


use App\Models\Execl\GameConfig;
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
        var_dump("createMailMsg");
        $data['Read'] = false;
        $data['Reward'] = false;
        $data['SendTime'] = time();
        $GameConfig = new GameConfig();
        $data['SenderIcon'] = $GameConfig->getMailNpcHead();
        $data['SenderName'] = $GameConfig->getMailNpcName();
        $data['SenderId'] = 'system';

        var_dump($data);
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            $Id =  Db::table($this->table)->getLastInsID();
            var_dump($Id);
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
        var_dump("getRedisMailByUid");
        $key = $this->MailList . $Uid;
        $data = $this->redis->HGETALL($key);
        var_dump($data);

        $list = [];
        foreach ($data as $datum =>$value) {
            $bool = $this->redis->exists($datum);
            if($bool){
                $list[] = json_decode($value,true);
            }else{
//                $this->redis->hDel($key,$datum);
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
        var_dump("setRedisMail");
        $key  = $this->Mail . $Uid  . ':' .  (string)$data['_id'];
        $rs = $this->redis->setex($key,$this->expiry,json_encode($data));
//        var_dump($key);
        $this->redis->hSet('MailList:'.$Uid,$key,json_encode($data));
        return true;
    }

    /**
     * 设置已读
     * @param $Id
     * @return int|string
     */
    public function getRead($Id)
    {
        $rs = Db::table($this->table)->where('_id',$Id)->update(['Read'=>true]);
        return $rs;
    }
}