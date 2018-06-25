<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 上午11:50
 */
namespace App\Protobuf\Result;

use App\Models\Bank\SavingGold;
use App\Models\Company\Company;
use App\Models\Company\Shop;
use App\Models\Staff\LottoLog;
use App\Models\User\FriendApply;
use App\Models\User\Role;

class JoinGameResult
{
    public static function encode($arr)
    {
        $uid = $arr['uid'];
        $JoinGameResult = new \AutoMsg\JoinGameResult();
        //设置角色信息
        var_dump("设置角色信息");
        var_dump($uid);
          var_dump('设置服务器时间');
        $str_role = LoadRoleInfo::encode($uid);
 var_dump('sssss');
        $JoinGameResult->setLoadRoleInfo($str_role);
        var_dump('设置服务器时间');


        //设置服务器时间
        $LoadServerConfig = LoadServerConfig::encode();
        $JoinGameResult->setServerConfig($LoadServerConfig);
        //设置任务信息
        var_dump("设置任务信息");
        $MissionResult = MissionResult::encode();

        $JoinGameResult->setMission($MissionResult);
         var_dump('背包信息');

        //背包信息
        var_dump('背包信息');
        $LoadBagInfo = LoadBagInfo::encode($uid);
        $JoinGameResult->setRoleBag($LoadBagInfo);
        //技能列表
        $SkillResult = SkillResult::encode();
        $JoinGameResult->setSkillResult($SkillResult);
         var_dump('每日充值限额');
        //每日充值限额
        $DayCountInfo = DayCountInfo::encode();
        $JoinGameResult->setDayCountInfo($DayCountInfo);

         var_dump('123456');
        //好友
//        $FriendApply = new FriendApply();
//        $data_Friends = $FriendApply->getFriendApply($uid);
//        var_dump("getFriendApply");
//        var_dump($data_Friends);
        $FriendInfo = new \App\Models\FriendInfo\FriendInfo();
        $data_Friends = $FriendInfo->getFriendInfoByUid($uid);
        var_dump("好友");
        $Friend = FriendListResult::encode($data_Friends);
        $JoinGameResult->setFriend($Friend);
        //公司
        $Company = new Company();
        $data_Company = $Company->getCompany($uid);
        $CompanyInfo = LoadCompanyInfo::encode($data_Company);
        $JoinGameResult->setCompanyInfo($CompanyInfo);
        //店铺
        $MapInfo = GetMapResult::encode($uid,2);//店铺
        $JoinGameResult->setMapInfo($MapInfo);
        //店铺主管信息
        $Shop = new Shop();
        $TalentDatas = $Shop->getMasterByUid($uid);
        $JoinGameResult->setTalentDatas($TalentDatas);
        //招聘抽奖
        $TypeCountStaff = TypeCountStaffResult::encode($uid);
        $JoinGameResult->setTypeCountStaff($TypeCountStaff);
        //银行
        $Save = new SavingGold();
        $data_SavingInfo = $Save->getListByUid($uid);
        $LoadingGoldResult =[];
        foreach ($data_SavingInfo as $item) {
            $LoadingGoldResult[] = SavingInfo::ecode($item);
        }
        $JoinGameResult->setLoadingGoldResult($LoadingGoldResult);
        //邮件
        $MailMsg = new \App\Models\Mail\MailMsg();
        $data = $MailMsg->getRedisMailByUid($uid);

        $Mails = MailResult::encode($data);
        $JoinGameResult->setMails($Mails);
        //住宅信息 TODO::
        $data = [
            ['uid' => $uid,'roomId' => 202,'config' => []],
            ['uid' => $uid,'roomId' => 203,'config' => []],
            ['uid' => $uid,'roomId' => 204,'config' => []],
        ];
        $roomResult = RoomListResult::encode($data);
        $JoinGameResult->setRoom($roomResult);

        $str = $JoinGameResult->serializeToString();
        return $str;
    }
}