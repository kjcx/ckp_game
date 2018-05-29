<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/9
 * Time: 下午3:19
 */

namespace App\Models\Company;


use App\Models\Model;
use think\Db;

class Company extends Model
{
    public $table = 'ckzc.Company';

    /**创建公司
     * @param $data
     * @return bool
     */
    public function CreateCompany($data)
    {
        $data['Icon'] = '';//客户端自己读取
        $data['Desc'] = '';//客户端自己读取
        $data['Level'] = 0;//
        $data['SocialStatus'] = 0;//公司身价值
        $data['ShopNumber'] = 0;//店铺数量
        $data['StaffNumber'] = 0;//当前员工数量
        $data['ClientValue'] = 0;//客流量
        $data['CompanyValue'] = 0;//客流量
        $CreateTime = time();//时间戳
        $data['CreateTime'] = time();
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 检查公司名字是否存在
     * @param $name
     * @return array|bool|false|null|\PDOStatement|string|\think\Model
     */
    public function checkCompanyName($name)
    {
        $data = Db::table($this->table)->where(['CompanyName'=>$name])->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 获取公司信息
     * @param $uid
     * @return array
     */
    public function getCompany($uid)
    {
        $data = Db::table($this->table)->where('Uid',$uid)->find();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 获取公司名称
     * @param $uid
     * @return bool|mixed
     */
    public function getCompanyName($uid)
    {
        $data = Db::table($this->table)->field('Name')->where('Uid',$uid)->find();
        if($data){
            return $data['Name'];
        }else{
            return false;
        }
    }
}