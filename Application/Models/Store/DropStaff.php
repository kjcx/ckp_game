<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午12:04
 */

namespace App\Models\Store;


use App\Models\Model;

class DropStaff extends Model
{
    /**
     * 随机员工
     * @param $Type 员工类型 校园
     * @param $IsFree 是否免费
     * @return mixed
     */
    public function rand($Type,$IsFree)
    {
//        TODO
        $data['Id'] = rand(1,10);
        $data['Name'] = 'kjcx' . rand(1000,9999);
        $data['Pos'] = 0;//任职岗位
        $data['NpcId'] = rand(1,10);
        $data['EmployersDate'] = 0;//雇佣日期
        $data['ComprehensionTime'] = 100;//可培训次数
        $data['Appointed'] = false;//是否已任职
        $data['BasicProperties'] = [1=>1];//基础属性：
        $data['LevelUpTime'] = 1;//升级次数
        $data['Type'] = $Type;//类型
        return $data;
    }
}