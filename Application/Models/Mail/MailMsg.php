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
    public $table = 'Mail';

    /**
     * 获取邮件列表
     * @param $uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getMailMsg($uid)
    {
        $data = Db::table($this->table)->where(['uid'=>$uid])->select();
        return $data;
    }

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
            return true;
        }else{
            return false;
        }
    }
}