<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午12:04
 */

namespace App\Models\Store;


use App\Models\Execl\Drop;
use App\Models\Execl\Lotto;
use App\Models\Execl\Randomname;
use App\Models\Model;
use App\Models\Staff\Staff;

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
        mt_srand();
        $data['Id'] =  mt_rand(1,10);
        $data['Name'] = 'kjcx' . mt_rand(1000,9999);
        $data['Pos'] = 0;//任职岗位
        $data['NpcId'] = rand(1,10);
        $data['EmployersDate'] = 0;//雇佣日期
        $data['ComprehensionTime'] = 100;//可培训次数
        $data['Appointed'] = false;//是否已任职
        $data['BasicProperties'] = c;//基础属性：
        $data['LevelUpTime'] = 1;//升级次数
        $data['Type'] = $Type;//类型
        return $data;
    }

    /**
     * 获取免费掉落库
     * @param $Type
     * @return
     */
    public function getLottoFreeDropLib($Type)
    {
        //        2001,10000;2002,2000;2003,300
        $Lotto = new Lotto();
        $info = $Lotto->getLootoInfo($Type);
        $list = explode(';',$info['FreeDropLib']);
        $FreeDropLibs = [];
        $FreeDropLib_gailu = [];
        foreach ($list as $item) {
            $arr = explode(',',$item);
            $FreeDropLib['Id'] = $arr[0];
            $FreeDropLib['Num'] = $arr[1];
            $FreeDropLibs[] = $FreeDropLib;
        }
        return $FreeDropLibs;
    }

    /**
     * 获取收费掉落库
     * @param $Type
     * @return
     */
    public function getLottoDropLib($Type)
    {
        $Lotto = new Lotto();
        $info = $Lotto->getLootoInfo($Type);
        $list = explode(';',$info['DropLib']);
        $DropLibs = [];
        foreach ($list as $item) {
            $arr = explode(',',$item);
            $FreeDropLib['Id'] = $arr[0];
            $FreeDropLib['Num'] = $arr[1];
            $DropLibs[] = $FreeDropLib;
        }
        return $DropLibs;
    }

    /**
     * 获取本次随机的id
     */
    public function mt_rand($data)
    {
        $arr = [];
        foreach ($data as $datum) {
            $max = $datum['Num'];
            for($i=0;$i<$max;$i++){
//                yield $max;
                $arr[] = $datum['Id'];
            }
        }
        mt_srand();
        return $arr[array_rand($arr)];
    }

    /**
     * 获取掉落的id信息
     * @param $DropId
     * @return
     */
    public function getDropLibInfo($DropId)
    {
        $Drop = new Drop();
        $data = $Drop->getInfoById($DropId);
        if($data){
            return $data['DropLib'];
        }else{
//            var_dump(__FILE__ . __LINE__ ."id有误");
        }
    }

    /**
     * 获取掉落库具体 随机出来的npcid和数量
     * @param $DropLib
     * @return array
     */
    public function getRadnDropLib($DropLib)
    {
        $arr = explode(';',$DropLib);
        foreach ($arr as $item) {
            $res = explode(',',$item);//每一个数据数组包含id 随机最小值 最大值 概率
            $quanzhong = $res[3];
            for($i=0;$i<$quanzhong;$i++){
                $arr_quanzhong[] = $res[0];
            }
            $arr_min_max[$res[0]] = [$res[1],$res[2]];//最小值，最大值
//            $arr_min_max[$res[0]] = [$res[1],10];
        }
        mt_srand();
        $StaffId = $arr_quanzhong[array_rand($arr_quanzhong)];
        mt_srand();
        $num = mt_rand($arr_min_max[$StaffId][0],$arr_min_max[$StaffId][1]);
//        var_dump($num,$StaffId);
        return ['StaffId'=>$StaffId,'Num'=>$num];
    }

    /**
     * 获取员工信息
     * @param $data
     * @return
     */
    public function getStaffInfo($data)
    {
        $Staff = new \App\Models\Execl\Staff();
        $data_Staff = $Staff->getInfoById($data['StaffId']);
//        var_dump($data_Staff);
        $Quality = $data_Staff['Quality'];//品质
        $Attribute = $data_Staff['Attribute'];//属性
        $Attributes = explode(';',$Attribute);
        $arr = [];
        foreach ($Attributes as $attribute) {
            $res = explode(',',$attribute);
            $arr[$res[0]] = $res[1];
        }
        $insert['NpcId'] = $data['StaffId'];
        $Randomname = new Randomname();
        $xing = $Randomname->getRandSurName();
        $insert['Name'] = $xing . $data_Staff['Name'];
        $insert['EmployersDate'] = 0;
        $insert['BasicProperties'] = $arr;
        $insert['ComprehensionTime'] = 0;//今日培训次数
        $insert['Quality'] = $Quality;//员工配置
        return $insert;
    }

    /**
     * 获取抽奖次数
     * @param $Type
     * @return mixed
     */
    public function getNumber($Type)
    {
        $Lotto = new Lotto();
        $info = $Lotto->getLootoInfo($Type);
        return $info['Number'];
    }

}