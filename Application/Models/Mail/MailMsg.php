<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 下午1:35
 */

namespace App\Models\Mail;


use App\Event\UserEvent;
use App\Models\BagInfo\Bag;
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
            //通知用户 如果在线
            $UserEvent = new UserEvent($data['Uid']);

            $UserEvent->MailResultEvent($data);

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
     * @param $Uid
     * @param $Id
     * @return int|string
     */
    public function setRead($Uid,$Id)
    {
        $rs = Db::table($this->table)->where('_id',$Id)->update(['Read'=>true]);
        $this->setRedisRead($Uid,$Id);
        return $rs;
    }

    /**
     * 设置已读
     * @param $Uid
     * @param $Id
     * @return bool|int
     */
    public function setRedisRead($Uid,$Id)
    {
        $str = $this->redis->hGet($this->MailList . $Uid,$this->Mail . $Uid .':' .$Id);
        $arr = json_decode($str,true);
        $arr['Read'] = true;
        $rs = $this->redis->hSet($this->MailList . $Uid,$this->Mail . $Uid .':' .$Id,json_encode($arr));
        return $rs;
    }

    /**
     * 设置已获得礼品
     * @param $Uid
     * @param $Ids
     * @return bool
     */
    public function setRewardByIds($Uid,$Ids)
    {
        $key = $this->MailList . $Uid;
        $Bag = new Bag($Uid);
        $data = $this->redis->hGetAll($key);
//        var_dump($data);
        foreach ($data as $datum =>$value) {
            $item = json_decode($value,true);
            if(in_array($datum,$Ids)){
                foreach ($item['Item'] as $k => $v) {
                    $rs = $Bag->addBag($k,$v);
                    $item['Reward'] = true;
                    $this->redis->hSet($key,$datum,json_encode($item));
                    $rs = $this->setReward($v['_id']);
                    if(!$rs){
                        var_dump("添加失败");
                    }
                }
            }
        }
        return true;
    }

    /**
     * 设置mongo 已领取
     * @param $Id
     * @return int|string
     */
    public function setReward($Id)
    {
        $arr['Reward'] = true;
        $rs = Db::table($this->table)->where('_id',$Id)->update($arr);
        return $rs;
    }

    /**
     * 删除邮件
     * @param $Uid
     * @param $Ids
     */
    public function DelRedisMail($Uid,$Ids)
    {
        $key = $this->MailList . $Uid;
        $data = $this->redis->hGetAll($key);
        foreach ($data as $datum =>$value) {
            $arr = json_decode($value,true);
            if(in_array($arr['_id'],$Ids)){
                //删除redis
                $rs = $this->redis->hDel($key,$datum);
                //删除mongo
                $rs = Db::table($this->table)->where('_id',$arr['_id'])->delete();
                if(!$rs){
                    var_dump("删除邮件失败");
                }
            }
        }
    }
}