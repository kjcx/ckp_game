<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午1:56
 */
namespace  App\Websocket\Controller;

use App\Event\ChangeAvatarEvent;
use App\Event\ChangeAvatarSubscriber;
use App\Event\ChangeItemEvent;
use App\Event\ItemEvent;
use App\Event\ChangeItemSubscriber;
use App\Event\RoleCreateEvent;
use App\Event\SellItemEvent;
use App\Event\UserEvent;
use App\Models\BagInfo\Bag;
use App\Models\Bank\LoansInfo;
use App\Models\Bank\SavingGold;
use App\Models\Company\Company;
use App\Models\Company\ConsumeResult;
use App\Models\Company\Shop as CompanyShop;
use App\Models\Company\TalentMarketInfo;
use App\Models\DataCenter\DataCenter;
use App\Models\Excel\BuildingLevel;
use App\Models\Excel\Entrust;
use App\Models\Excel\Favour;
use App\Models\Excel\GameConfig;
use App\Models\Excel\Item;
use App\Models\Excel\LandInfo;
use App\Models\Excel\Lotto;
use App\Models\Excel\Npc;
use App\Models\Excel\Sign;
use App\Models\Excel\Topup;
use App\Models\Excel\TotalRewards;
use App\Models\Excel\Train;
use App\Models\Excel\WsResult;
use App\Models\FriendInfo\FriendInfo;
use App\Models\FruitsData\FruitsData;
use App\Models\Log\Pay;
use App\Models\Mail\MailMsg;
use App\Models\Manor\Land;
use App\Models\LandInfo\MyLandInfo;
use App\Models\Npc\NpcInfo;
use App\Models\Npc\NpcTask;
use App\Models\Pk\PkInfo;
use App\Models\Rank\RankList;
use App\Models\Room\Room;
use App\Models\Sales\SalesItem;
use App\Models\Sign\SignInfo;
use App\Models\Staff\LottoLog;
use App\Models\Staff\Staff;
use App\Models\Store\Seed;
use App\Models\Trade\Shop;
use App\Models\User\Account;
use App\Models\User\FriendApply;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;
use App\Protobuf\Req\AccomplishResidentDelegateReq;
use App\Protobuf\Req\AddNpcRelationAdvanceReq;
use App\Protobuf\Req\AddSoilReq;
use App\Protobuf\Req\AuctionLandReq;
use App\Protobuf\Req\BuildLvUpReq;
use App\Protobuf\Req\ChangeAvatarReq;
use App\Protobuf\Req\ChatToChatReq;
use App\Protobuf\Req\CKApiReq;
use App\Protobuf\Req\ComeOutEmployeeReq;
use App\Protobuf\Req\ConsumeReq;
use App\Protobuf\Req\CreateBuildReq;
use App\Protobuf\Req\CreateCompanyReq;
use App\Protobuf\Req\CultivateEmployeeReq;
use App\Protobuf\Req\DaySignReq;
use App\Protobuf\Req\DelMailsReq;
use App\Protobuf\Req\DestoryBuildReq;
use App\Protobuf\Req\DismantleReq;
use App\Protobuf\Req\DismissalEmployeeReq;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\FriendAddBlackReq;
use App\Protobuf\Req\FriendAddReq;
use App\Protobuf\Req\FriendApplyClearReq;
use App\Protobuf\Req\FriendApplyReq;
use App\Protobuf\Req\FriendRemoveBlackReq;
use App\Protobuf\Req\FriendRemoveReq;
use App\Protobuf\Req\FriendSearchReq;
use App\Protobuf\Req\FurnitureStarReq;
use App\Protobuf\Req\GetMailItemsReq;
use App\Protobuf\Req\GetMapReq;
use App\Protobuf\Req\GetPraiseRoleIdReq;
use App\Protobuf\Req\GrowPlantsReq;
use App\Protobuf\Req\HarvestPlantReq;
use App\Protobuf\Req\HarvestPublicShopReq;
use App\Protobuf\Req\LoansReq;
use App\Protobuf\Req\MoneyChangeReq;
use App\Protobuf\Req\NoBodyShopReq;
use App\Protobuf\Req\NpcRelationAdvanceReq;
use App\Protobuf\Req\PickUpSevenDaysReq;
use App\Protobuf\Req\RankingReq;
use App\Protobuf\Req\ReadMailReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\RefFitnessReq;
use App\Protobuf\Req\RefStaffReq;
use App\Protobuf\Req\RequestManorReq;
use App\Protobuf\Req\RoomLiveReq;
use App\Protobuf\Req\RoomReq;
use App\Protobuf\Req\RoomUpdateReq;
use App\Protobuf\Req\RoomVisitReq;
use App\Protobuf\Req\SavingGoldReq;
use App\Protobuf\Req\SeedShopPingReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Req\SignNameReq;
use App\Protobuf\Req\SignReq;
use App\Protobuf\Req\SoldOutReq;
use App\Protobuf\Req\StealSemenReq;
use App\Protobuf\Req\TalentFireReq;
use App\Protobuf\Req\TalentHireReq;
use App\Protobuf\Req\TalkIngGroupChangeReq;
use App\Protobuf\Req\TalkingGroupReq;
use App\Protobuf\Req\TalkIngGroupResidentChangeReq;
use App\Protobuf\Req\TalkingGroupResidentReq;
use App\Protobuf\Req\TopUpGoldReq;
use App\Protobuf\Req\UnlockNpcReq;
use App\Protobuf\Req\UpdateRoleInfoNameReq;
use App\Protobuf\Req\UseCompostReq;
use App\Protobuf\Req\UseItemReq;
use App\Protobuf\Req\UserBuyReq;
use App\Protobuf\Req\UserSalesReq;
use App\Protobuf\Result\AccomplishResidentDelegateResult;
use App\Protobuf\Result\AddNpcRelationAdvanceResult;
use App\Protobuf\Result\AddSoilResult;
use App\Protobuf\Result\AuctionLandResult;
use App\Protobuf\Result\BuildLvUpResult;
use App\Protobuf\Result\ChangeAvatarResult;
use App\Protobuf\Result\ChatToChatResult;
use App\Protobuf\Result\CkPayResult;
use App\Protobuf\Result\ComeOutEmployeeResult;
use App\Protobuf\Result\CreateBuildResult;
use App\Protobuf\Result\CreateCompanyResult;
use App\Protobuf\Result\CultivateEmployeeResult;
use App\Protobuf\Result\DaySignResult;
use App\Protobuf\Result\DelMailsResult;
use App\Protobuf\Result\DestoryBuildResult;
use App\Protobuf\Result\DismantleResult;
use App\Protobuf\Result\DismissalEmployeeResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\FriendAddBlackResult;
use App\Protobuf\Result\FriendAddResult;
use App\Protobuf\Result\FriendApplyClearResult;
use App\Protobuf\Result\FriendApplyResult;
use App\Protobuf\Result\FriendOnlineResult;
use App\Protobuf\Result\FriendRemoveBlackResult;
use App\Protobuf\Result\FriendRemoveResult;
use App\Protobuf\Result\FriendSearchResult;
use App\Protobuf\Result\FruitsDataResult;
use App\Protobuf\Result\FurnitureStarResult;
use App\Protobuf\Result\GetAuctionLandResult;
use App\Protobuf\Result\GetMailItemsResult;
use App\Protobuf\Result\GetMapResult;
use App\Protobuf\Result\GetPraiseRoleIdResult;
use App\Protobuf\Result\GetRankingResult;
use App\Protobuf\Result\GetTalentListResult;
use App\Protobuf\Result\GrowPlantsResult;
use App\Protobuf\Result\HarvestPlanResult;
use App\Protobuf\Result\HarvestPublicShopResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\LoadStaffResult;
use App\Protobuf\Result\ManorVisitInfoResult;
use App\Protobuf\Result\LoansResult;
use App\Protobuf\Result\MissionFirstCompleteResult;
use App\Protobuf\Result\ModelClothesResult;
use App\Protobuf\Result\MoneyChangeResult;
use App\Protobuf\Result\MyLandInfoResult;
use App\Protobuf\Result\NoBodyShopResult;
use App\Protobuf\Result\NpcFavorabilityResult;
use App\Protobuf\Result\NpcListResult;
use App\Protobuf\Result\OnGetMyGoodsResult;
use App\Protobuf\Result\PickUpSevenDaysResult;
use App\Protobuf\Result\PkRankingResult;
use App\Protobuf\Result\RaffleFruitsResult;
use App\Protobuf\Result\RandManorResult;
use App\Protobuf\Result\RankingResult;
use App\Protobuf\Result\ReadMailResult;
use App\Protobuf\Result\RefDropShopResult;
use App\Protobuf\Result\RefFitnessResult;
use App\Protobuf\Result\RefStaffResult;
use App\Protobuf\Result\RequestManorResult;
use App\Protobuf\Result\ResidentDelegateResult;
use App\Protobuf\Result\RoleAuctionShopResult;
use App\Protobuf\Result\RoomLiveResult;
use App\Protobuf\Result\RoomResult;
use App\Protobuf\Result\RoomUpdateResult;
use App\Protobuf\Result\RoomVisitInfoResult;
use App\Protobuf\Result\RoomVisitResult;
use App\Protobuf\Result\SalesListResult;
use App\Protobuf\Result\SavingGoldResult;
use App\Protobuf\Result\ScoreShopResult;
use App\Protobuf\Result\SeedShopPingResult;
use App\Protobuf\Result\SellItemResult;
use App\Protobuf\Result\SignNameResult;
use App\Protobuf\Result\SignResult;
use App\Protobuf\Result\SoldOutResult;
use App\Protobuf\Result\StealSemenResult;
use App\Protobuf\Result\TalentFireResult;
use App\Protobuf\Result\TalentHireResult;
use App\Protobuf\Result\TalentRefreshResult;
use App\Protobuf\Result\TalkIngGroupChangeResult;
use App\Protobuf\Result\TalkIngGroupResidentChangeResult;
use App\Protobuf\Result\TalkingGroupResidentResult;
use App\Protobuf\Result\TalkingGroupResult;
use App\Protobuf\Result\TopUpGoldResult;
use App\Protobuf\Result\UnlockNpcResult;
use App\Protobuf\Result\UpdateRoleInfoIconResult;
use App\Protobuf\Result\UpdateRoleInfoNameResult;
use App\Protobuf\Result\UpgradeLandLevelReq;
use App\Protobuf\Result\UpgradeLandLevelResult;
use App\Protobuf\Result\UseCompostResult;
use App\Protobuf\Result\UseItemResult;
use App\Protobuf\Result\UserBuyResult;
use App\Protobuf\Result\UserSalesResult;
use App\Task\Mass;
use EasySwoole\Core\Component\Spl\SplStream;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Socket\Client\WebSocket;
use EasySwoole\Core\Socket\Common\CommandBean;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Models\Excel\GameGifts;

class Web extends WebSocketController
{
    public $data;
    public $uid;
    public $fd;

    function __construct(WebSocket $client, CommandBean $request, SplStream $response)
    {
        $this->data = $request->getArg('data');
        $this->fd = $client->getFd();
        $msgid = $request->getAction();
        if($msgid != 'msgid_1004' ){
            $dataCenter = new \App\Models\DataCenter\DataCenter();
            $this->uid = $dataCenter->getUidByFd($this->fd);
        }
        parent::__construct($client, $request, $response);

    }


    function actionNotFound(?string $actionName)
    {

        parent::actionNotFound($actionName); // TODO: Change the autogenerated stub
    }

    /**
     * 向所有人推送的控制器
     */
    public function pp()
    {

    }

    /**
     * 庄园买地块
     */
    public function msgid_1078()
    {
        $data = AddSoilReq::decode($this->data);
        $land = new Land($this->uid);
        $id = $land->unlockLand($data['landId']);
        if (isset($id['error'])) {
            $this->send(1110,$this->fd,0,$id['msg'],12);
        } else {
            $string = AddSoilResult::encode(['id' => $id]);
            $this->send(1110,$this->fd,$string);
        }

    }

    /**
     * 庄园种植
     */
    public function msgid_1055()
    {
        $data = GrowPlantsReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->plant($data['id'], $data['semenId']);
        if (isset($res['error'])){
            $this->send(1085,$this->fd,0,$res['msg'],12);
        } else {
            $string = GrowPlantsResult::encode($res);
            $this->send(1085,$this->fd,$string);
        }
    }

    /**
     *庄园土地收获
     */
    public function msgid_1056()
    {
        $data = HarvestPlantReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->harvest($data['landId']);
        if (isset($res['error'])){
            $this->send(1086,$this->fd,0,$res['msg'],12);
        } else {
            $string = HarvestPlanResult::encode($res);
            $this->send(1086,$this->fd,$string);
        }
    }

    /**
     * 铲除地块作物
     */
    public function msgid_1062()
    {
        $data = DismantleReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->eradicate($data['landId'],$data['uid']);
        if (isset($res['error'])){
            $this->send(1092,$this->fd,0,$res['msg'],12);
        } else {
            $string = DismantleResult::encode(['landId' => $res]);
            $this->send(1092,$this->fd,$string);
        }
    }
    /**
     * 发送
     * @param $MsgId
     * @param $fd
     * @param $data
     * @param $Result
     * @param $ErrorMsg
     */
    public function send($MsgId,$fd,$data,$Result=0,$ErrorMsg='')
    {
        if($Result){
            $WsResult = new WsResult();
            if (empty($ErrorMsg)) {
                $data_ws = $WsResult->getOne($Result);
            } else {
                $data_ws = $WsResult->getErrorValue($Result);
            }
            $value = (int)$data_ws['value'];
        }else{
            $value = 0;
        }
        $str  = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data,$value,$ErrorMsg);

        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 异步发送
     * @param $Uids
     * @param $data
     */
    public function sendTask($MsgId,$Uids,$data)
    {
        $str  = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data);
        $DataCenter = new DataCenter();

        foreach ($Uids as $uid) {
            $fd = $DataCenter->getFdByUid($uid);
            $online = ServerManager::getInstance()->getServer()->exist($fd);
            if(!$online){
                continue;
            }
            $arr['fd'] = $fd;
            $arr['data'] = $str;
            $massTemplate = new Mass($arr);
            \EasySwoole\Core\Swoole\Task\TaskManager::async($massTemplate);
        }

    }
    public function sendByUid($MsgId,$uid,$data,$Result=0,$ErrorMsg='')
    {
        $DataCenter = new DataCenter();
        $fd = $DataCenter->getFdByUid($uid);
        if(!$fd){
            var_dump("uid:".$uid."不在线");
            return;
        }
        $online = ServerManager::getInstance()->getServer()->exist($fd);
        if(!$online){
            var_dump("uid" . $uid . "已经离线");
            return;
        }
        if($Result){
            $WsResult = new WsResult();
            if (empty($ErrorMsg)) {
                $data_ws = $WsResult->getOne($Result);
            } else {
                $data_ws = $WsResult->getErrorValue($Result);
            }
            $value = (int)$data_ws['value'];
        }else{
            $value = 0;
        }
        $str  = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data,$value,$ErrorMsg);
        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
    }
    /**
     * 登录websocket服务器
     * 消息id 1004
     */
    public function msgid_1004()
    {

        $Data = $this->data;
        $token = \App\Protobuf\Req\ConnectingReq::decode($Data);

        //redis查询token是否存在
        $Account = new Account();
        $uid = $Account->getToken($token);
        if($uid){
            $dataCenter = new \App\Models\DataCenter\DataCenter();
            $r = $dataCenter->saveClient($this->fd,$uid);
            var_dump($r);
            //登录成功
            $data = \App\Protobuf\Result\ConnectingResult::encode($uid);

           $this->send(1057,$this->fd,$data);
        }else{
            $data = \App\Protobuf\Result\ConnectingResult::encode(36);
            $this->send(1057,$this->fd,$data);
        }

    }

    /**
     * 角色创建
     * 消息id 1007
     */
    public function msgid_1007()
    {
        $Data = $this->data;
        $data_role = \App\Protobuf\Req\CreateRoleReq::decode($Data);
        $Role = new Role();
        //1验证角色名称是否存在
        if($Role->checkNickName($data_role['Name'])){
            $data = \App\Protobuf\Result\CreateRoleResult::encode($data_role);
            $WsResult = new WsResult();
            $data_ws = $WsResult->getOne('角色名已经存在');
            $str  = \App\Protobuf\Result\MsgBaseSend::encode(1060,$data,$data_ws['value']);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            //验证角色名称是否存在   角色名已经存在
        }else{
            //2创建角色
            $rs = $Role->createRole($this->uid,$data_role['Name'],$data_role['Sex']);//创建角色
            if($rs){
                //角色创建成功
                $data_role['RoleId'] = $rs;
                $data = \App\Protobuf\Result\CreateRoleResult::encode($data_role);
                $str  = \App\Protobuf\Result\MsgBaseSend::encode(1060,$data);
                event(RoleCreateEvent::class,$this->uid);
                ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            }else{
                //角色创建失败
            }
        }

    }

    /**
     * 加入游戏
     * 消息id 1012
     */
    public function msgid_1012()
    {

        //加入游戏
        $data = JoinGameResult::encode(['uid'=>$this->uid]);
        $this->send(1066,$this->fd,$data);
        //通知好友用户上线
        $str = FriendOnlineResult::encode(['Uid'=>$this->uid,'Online'=>true]);
        $Friend = new FriendInfo();
        $Uids = $Friend->getUidByFriendStatus($this->uid,1);

       if($Uids){
           $this->sendTask(1020,$Uids,$str);//好像上线下
       }
    }

    /**
     * 刷新商城商品
     * 消息id 1077
     */
    public function msgid_1077()
    {
        $Data = $this->data;
        $shopType = RefDropShopReq::decode($Data);
        $str = RefDropShopResult::encode($shopType);
        $this->send($this->fd,$str);
    }

    /**
     * 掉落库商品购买
     * 消息id 1075
     */
    public function msgid_1075()
    {
        $Data = $this->data;
        $data_DropShopPingReq = DropShopPingReq::encode($Data);
        $ShopTypeId = $data_DropShopPingReq['ShopTypeId'];
        $ItemId = $data_DropShopPingReq['ItemId'];
        $DropKuId = $data_DropShopPingReq['DropKuId'];
        $GridId = $data_DropShopPingReq['GridId'];

        $Bag = new Bag($this->uid);
        $rs = $Bag->addBag($ItemId,1);
        if($rs){
            $data = DropShopPingResult::encode($data_DropShopPingReq);
            $this->send(1107,$this->fd,$data);
        }
//        $RoleBag->updateRoleBag($this->uid,['id'=>$ItemId,'CurCount'=>9]);
        //返回结果
        //调用事件
        $dispatcher = new EventDispatcher();
        $subscriber = new ChangeItemSubscriber();
        $dispatcher->addSubscriber($subscriber);
        $ids = [$ItemId];
        $dispatcher->dispatch('BuyItem',new ChangeItemEvent($this->uid,$ids));
    }

    /**
     * 请求加载商店
     * 消息id 1106
     */
    public function msgid_1106()
    {
        //请求加载商店
        $data = \App\Protobuf\Result\ShopAllResult::encode($this->uid);
        $this->send(1145,$this->fd,$data);
    }

    /**
     * SellItemReq 出售道具
     * 消息id 1069
     */
    public function msgid_1014()
    {
        $Data = $this->data;
        $data_SellItemReq = SellItemReq::decode($Data);
        //计算道具所需价格
        $Item = new Item();
        $PriceType  = $Item->getSellItemInfo($data_SellItemReq);
        //出售道具事件
        if($PriceType){
            //出售成功
            $Bag = new Bag($this->uid);
            $Bag->delBag($data_SellItemReq['ItemId'],$data_SellItemReq['Count']);
            foreach ($PriceType as $k => $v) {
                $update_bag1 = ['id'=>$k,'CurCount'=>$v];//金币增加
                $Bag->addBag($k,$v);
            }
            $data = SellItemResult::encode($this->uid);
            $this->send(1069,$this->fd,$data);
            //调用事件
            $dispatcher = new EventDispatcher();
            $subscriber = new ChangeItemSubscriber();
            $dispatcher->addSubscriber($subscriber);
            $ids = [$data_SellItemReq['ItemId']];
            $dispatcher->dispatch('SellItem',new ChangeItemEvent($this->uid,$ids));
        }else{
        }

    }
    /**
     * 请求积分商店
     * 消息id 1142
     */
    public function msgid_1142()
    {
        $data = $this->data;
        $data_ScoreShop = ScoreShopResult::encode();
        //var_dump($data_ScoreShop);
        $this->send(1193,$this->fd,$data);
    }

    /**
     * 改变时装请求
     * 消息id 1002
     */
    public function msgid_1002()
    {
        $Data = $this->data;
        //1 解析属性id
        $ids = ChangeAvatarReq::decode($Data);
        //2修改用户属性
        $UserAttr = new UserAttr();
        $UserAttr->setUserAttr($this->uid,$ids);
        $data = ChangeAvatarResult::encode($this->uid);
        $this->send(1055,$this->fd,$data);
        //调用事件
        $dispatcher = new EventDispatcher();
        $subscriber = new ChangeAvatarSubscriber();
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch('changeAvatar',new ChangeAvatarEvent($this->uid,$ids));
    }

    /**
     * 购买时装
     * 消息id 1150
     */
    public function msgid_1150()
    {
        $Data = $this->data;
        $item_ids = \App\Protobuf\Req\ModelClothesReq::decode($Data);
        //购买时装操作 计算金额 放入背包
        $shop = new Shop();
        $bool = $shop->Buy($this->uid,$item_ids);
        if($bool){
            //加入背包
            $Bag = new Bag($this->uid);
            foreach ($item_ids as $id) {
                $bool = $Bag->addBag($id,1);
//                $RoleBag->updateRoleBag($this->uid,['id'=>$id,'CurCount'=>1]);
            }
            $data = ModelClothesResult::encode($item_ids);
            $this->send(1203,$this->fd,$data);
        }else{
            //余额不足
//            $res = Db::table('WsResult')->where(['msg'=>''])->find();
            $this->send(1203,$this->fd,0,'没有足够的金钱');
        }
    }


    /**
     * 更改头像
     */
    public function msgid_1102()
    {
        $Data = $this->data;
        $data_RoleInfoIcon = \App\Protobuf\Req\UpdateRoleInfoIconReq::decode($Data);
        //修改个人头像
        $role = new Role();
        $rs = $role->updateIcon($this->uid,$data_RoleInfoIcon['RoleIcon']);
        if($rs){
            //修改成功
            $data = UpdateRoleInfoIconResult::encode($data_RoleInfoIcon['RoleIcon']);
//            $str = \App\Protobuf\Result\MsgBaseSend::encode(1141,$data);
            $this->send(1141,$this->fd,$data);
        }else{

        }
    }

    /**
     * 金币充值
     */
    public function msgid_1165()
    {
        var_dump($this->uid);
        $data_pay = CKApiReq::decode($this->data);
        $Id = $data_pay['PayParams']['Id'];
        $Pwd = $data_pay['PayParams']['Pwd'];

        //获取充值的id
        $Topup = new Topup();
        $data_Topup = $Topup->findById($Id);

        //判断app余额是否足够
        $Account = new Account();

        $res = $Account->payByApp($this->uid,$data_Topup['Gold'],$Pwd,'game_recharge');


        //$res['cdode']=400，测试时改为：200
        $res['code']=200;

        if($res['code'] == 200) {

            //充值成功
            $Pay = new Pay();

            //背包金额增加
            $Bag = new Bag($this->uid);

            //是否是首次充值
            //如果是首次充值，基本充值金额+首充奖励；如果不是，只有充值金额
            if ($Pay->getFirstRecharge($this->uid)) {
                var_dump($Pay->getFirstRecharge($this->uid));
                echo("是首次充值：奖励");
                //本次充值的总金额：充值金额+首充奖励
                //获取首充奖励数据
                $gamegifts = new GameGifts();
                $ft = $gamegifts->FirstTopup();

                //如果是金币（ID=2），充值金额+首充奖励
                foreach ($ft as $k => $value) {
                    //if ($k == 2) {
                    //    $ft[$k] = $value + $data_Topup['Gold'];
                    // }

                }
                //删除金币项目
                unset($ft[2]);

                //批量增加道具
                $Bag->batchAddBag($ft);


                $awardgold = $gamegifts->FirstTopupGold();

                var_dump($awardgold);

                //如果是首次充值，基本充值金额+首充奖励
                $awardgold += $data_Topup['Gold'];
                $rs = $Bag->addBag(2, $awardgold);
                //减少金币
                //$Bag->delBag(2,62500);
                if ($rs) {
                    $Pay->create(['Uid' => $this->uid, 'Gold' => $awardgold, 'CreateTime' => time()]);
                    //返回充值成功
                    $data = CkPayResult::encode(true);
                    $this->send(1224, $this->fd, $data);


                } else {
                    echo("不是首次充值");
                    //金币ID：2
                    $rs = $Bag->addBag(2, $data_Topup['Gold']);
                    //减少金币
                    //$Bag->delBag(2,62500);
                    if ($rs) {
                        $Pay->create(['Uid' => $this->uid, 'Gold' => $data_Topup['Gold'], 'CreateTime' => time()]);
                        //返回充值成功
                        $data = CkPayResult::encode(true);
                        $this->send(1224, $this->fd, $data);
                    }
                }
            } else {
                //充值失败
                $data = CkPayResult::encode(false);
                $WsResult = new WsResult();
                if ($res['datas']['error'] == '您输入的密码有误') {
//                $data_ws = $WsResult->getOne('APP支付密码不对');
                    $this->send(1224, $this->fd, $data, 'APP支付密码不对');
                } elseif ($res['datas']['error'] == '余额不足！！！') {
//                $data_ws = $WsResult->getOne('APP余额不足');
                    $this->send(1224, $this->fd, $data, 'APP余额不足');
                }
            }
        }
    }

    /**
     * 金币兑换创客币
     * 暂时没有了
     */
    public function msgid_1079()
    {
        $data = $this->data;
        $data_MoneyChange = MoneyChangeReq::decode($data);
        //处理兑换
        $Account = new Account();
        $Account->Change_Ckb_Gold($this->uid,$data_MoneyChange);
        $str = MoneyChangeResult::encode($data_MoneyChange);
        $this->send(1111,$this->fd,$str);
    }

    /**
     * 充值请求
     */
    public function msgid_1101()
    {
        $data = $this->data;
        $data_TopUpGold = TopUpGoldReq::decode($data);
        $str = TopUpGoldResult::encode(true);
        $this->send(1140,$this->fd,$str);
    }

    /**
     * 修改角色名称
     */
    public function msgid_1103()
    {
        $data = $this->data;
        $data_UpdateRoleInfoName = UpdateRoleInfoNameReq::decode($data);

        //修改角色名字
        $role = new Role();
        $user_gold = $role->getGold($this->uid);
        if($user_gold >=5000){
            if( $role->checkNickName($data_UpdateRoleInfoName['RoleName']) ){
                $data = \App\Protobuf\Result\CreateRoleResult::encode($data_UpdateRoleInfoName['RoleName']);
//                $WsResult = new WsResult();
//                $data_ws = $WsResult->getOne('角色名已经存在');
                $str  = \App\Protobuf\Result\MsgBaseSend::encode(1060,$data,'角色名已经存在');
                ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            }else{
                $rs = $role->updateRoleName($this->uid,$data_UpdateRoleInfoName['RoleName']);
                if($rs){
                    //昵称修改成功
                    $str = UpdateRoleInfoNameResult::encode($data_UpdateRoleInfoName['RoleName']);
                    $this->send(1142,$this->fd,$str);
                }
            }
        }else{
            //没有足够的金钱

            $this->send(1142,$this->fd,'','没有足够的金钱');
        }


    }

    /**
     * 聊天系统
     */
    public function msgid_1019()
    {
        $data = $this->data;
        echo '111111';
        $data_send_msg = \App\Protobuf\Req\SendMsgToChannelReq::decode($data);
    }

    /**
     * 快速完成任务
     */
    public function msgid_1149()
    {
        $data = $this->data;
        $data_MissionId = \App\Protobuf\Req\MissionFirstCompleteReq::decode($data);
        //任务id
        $str = MissionFirstCompleteResult::encode($data_MissionId);
        $this->send(1202,$this->fd,$str);
    }

    /**
     * 使用新手礼包
     */
    public function msgid_1015()
    {
        $data = $this->data;
        $data_UseItem = UseItemReq::decode($data);
        $Bag = new Bag($this->uid);
        //0.验证是否有此道具
        $data_bag = $Bag->checkBagHasItemById($data_UseItem['ItemId']);

        if($data_bag){
            if ($data_bag['CurCount'] >= $data_UseItem['Count']){
                //1 获取礼包规则
                $Item = new \App\Models\Excel\Item();
                $data_item = $Item->getItemUseEffetById($data_UseItem);
                //2 使用礼包
//                获得道具：1，道具ID，数量；1，道具ID2，数量
//                增加属性：2，属性ID，值；2，属性ID2，值
//                增加货币：3，货币ID，值；3，货币ID2，值
//                增加经验：4，经验值
//                打开UI：5，UI名字
//                    6掉落库
                $bool = false;
                foreach ($data_item as $ItemId=>$CurCount) {
                    $bool = $Bag->addBag($ItemId,$CurCount);
                }
                if($bool){
                    //使用成功 扣除礼包
                    $rs = $Bag->delBag($data_UseItem['ItemId'],$data_UseItem['Count']);

                    if($rs){
                        $ids[] =  $data_UseItem['ItemId'];
                        $str = UseItemResult::encode($this->uid,$data_item);
                        $this->send(1078,$this->fd,$str);
                        $dispatcher = new EventDispatcher();
                        $subscriber = new ChangeItemSubscriber();
                        $dispatcher->addSubscriber($subscriber);
                        $dispatcher->dispatch('UseItem',new ChangeItemEvent($this->uid,$ids));
                    }
                }
            }else{
                //道具数量不足
                $this->send(1078,$this->fd,'','道具数量不足');
            }
        }else{
            //道具不存在
            $this->send(1078,$this->fd,'','背包中没有该道具');
        }

    }

    /**
     * 创建公司
     * 1000
     */
    public function msgid_1006()
    {
        $data = $this->data;
        $data_Create = CreateCompanyReq::decode($data);
        //创建公司
        //1.验证公司名字
        $Company = new Company();
        $rs = $Company->checkCompanyName($data_Create['Name']);
        var_dump($data_Create);
        if($rs){
            $str = CreateCompanyResult::encode();
            $this->send(1059,$this->fd,'重名');
        }else{
            //判断是否已创建过
            $rs = $Company->getCompany($this->uid);
            if($rs){
                var_dump("玩家已经有公司");
                $this->send(1059,$this->fd,'玩家已经有公司');
            }else{
                var_dump("公司创建成功");
                $data_Create['Uid'] = $this->uid;
                $data = $Company->CreateCompany($data_Create);
                if($data){
                    //创建成功
                    //扣除营业执照
                    $Bag = new Bag($this->uid);
                    $rs = $Bag->delBag(151,1);
                    if($rs){
                        $str = CreateCompanyResult::encode($this->uid);
                        $this->send(1059,$this->fd,$str);
                    }else{
                        var_dump("扣除营业执照失败");
                    }

                }
            }

        }
    }

    /**
     * 显示点赞数
     */
    public function msgid_1111()
    {
        $data = $this->data;
        $data_info = GetPraiseRoleIdReq::decode($data);
        $uid = $data_info;
        $str = GetPraiseRoleIdResult::encode($uid);
        $this->send(1150,$this->fd,$str);
    }

    /**
     * 搜索&推荐玩家
     */
    public function msgid_1024()
    {
        $data = $this->data;
        $data_FriendSearch = FriendSearchReq::decode($data);
        var_dump($data_FriendSearch);
        //查找玩家
        $FriendInfo = new FriendInfo();
        $arr = $FriendInfo->SearchFriend($this->uid,$data_FriendSearch);
        $str = FriendSearchResult::encode($arr);
        $this->send(1016,$this->fd,$str);

//        $FriendInfo = new FriendInfo();
//        $FriendInfo->SearchFriend($this->uid,$data_FriendSearch);
    }

    /**
     * 申请加好友
     */
    public function msgid_1021()
    {
        $data = $this->data;
        $data_FriendApply = FriendApplyReq::decode($data);
        var_dump($data_FriendApply);
        //1添加好友申请
        $FriendInfo = new FriendInfo();

        //判断是不是好友
        $FriendStatus = $FriendInfo->getFriendStatusByFuid($this->uid,$data_FriendApply['RoleId']);

        var_dump("isFriend" . $FriendStatus);
        $is_setFriend  = false;
        $Is_Black  = false;
        if($FriendStatus == 0){//非好友
            $is_setFriend = $FriendInfo->setRedisFriend($this->uid,$data_FriendApply);
        }elseif ($FriendStatus == 1){
            //已经是好友
            $is_setFriend = true;
        }elseif ($FriendStatus == 2 || $FriendStatus == 3){
            //申请中
            $is_setFriend = true;
        }elseif ($FriendStatus == 4){
            //黑名单
            $Is_Black = true;
            $is_setFriend = true;
        }

        if($is_setFriend){
            //申请成功 1给申请人回复成功
//            获取申请人信息
            $Role = new Role();
            $data_role = $Role->getRole($data_FriendApply['RoleId']);
            $str = FriendApplyResult::encode($data_role,true);
            $this->send(1011,$this->fd,$str);
            //2 给被申请人通知
            $data_role = $Role->getRole($this->uid);
            $arr[] = $data_role;
            $str_other = FriendAddResult::encode($arr,0);
            $this->sendByUid(1011,$data_FriendApply['RoleId'],$str_other);
        }else{
            $str = FriendApplyResult::encode('',$this->uid,true,true);
            $this->send(1011,$this->fd,$str);
        }
    }

    /**
     * 通过好友申请
     */
    public function msgid_1022()
    {
        $data = $this->data;
        $data_FriendAdd = FriendAddReq::decode($data);//通过申请集合
        //修改状态
        var_dump($data_FriendAdd);
        $FriendInfo = new FriendInfo();
        $rs = $FriendInfo->passFriendApply($this->uid,$data_FriendAdd);
        //通过成功
        $data_userinfos = $FriendInfo->getFriendInfoByFuids($this->uid,$data_FriendAdd);

        if($rs){
            //给自己通知
            $str = FriendAddResult::encode($data_userinfos,1);
            $this->send(1013,$this->fd,$str);
            //给对方通知
            $data_info = $FriendInfo->getFriendStatus($this->uid,$data_FriendAdd);

            foreach ($data_info as $item) {
                $str_other = FriendAddResult::encode($item,false);
                $this->sendByUid(1013,$item['fuid'],$str_other);
            }
        }else{
            var_dump("已经是好友");
            $str = FriendAddResult::encode($data_userinfos,true);
            $this->send(1013,$this->fd,$str);
        }
    }

    /**
     * 拒绝用户申请
     */
    public function msgid_1025()
    {
        $data = $this->data;
        $data_FriendApplyClear = FriendApplyClearReq::decode($data);
        $FriendInfo = new FriendInfo();
        $FriendInfo->setRefuseFriend($this->uid,$data_FriendApplyClear);
        //拒绝申请返回
        $Role = new Role();
        $item = $Role->getRoleByUids($data_FriendApplyClear);

        $str = FriendApplyClearResult::encode($item,true);
        $this->send(1017,$this->fd,$str);
        $data_info = $FriendInfo->getFriendStatus($this->uid,$data_FriendApplyClear);
        var_dump("data_info");
        var_dump($data_info);
        //通知申请人
        foreach ($data_info as $item) {
            $new[] = $item;
            $str = FriendApplyClearResult::encode($new,false);
            $this->sendByUid(1017,$item['fuid'],$str);
        }

    }

    /**
     * 删除好友
     */
    public function msgid_1023()
    {
        $data = $this->data;
        $data_FriendRemove = FriendRemoveReq::decode($data);
        var_dump($data_FriendRemove);
        //
        $FriendInfo = new FriendInfo();
        $FriendInfo->setRemoveFriend($this->uid,$data_FriendRemove['RoleId']);

        $str = FriendRemoveResult::encode($data_FriendRemove);
        $this->send(1012,$this->fd,$str);
    }

    /**
     * 玩家私聊
     * result 1009
     */
    public  function msgid_1020()
    {
        $data = $this->data;
        $data_ChatToChat = ChatToChatReq::decode($data);
        var_dump($data_ChatToChat);
        $str = ChatToChatResult::encode();
        $this->send(1009,$this->fd,$str);
    }

    /**
     * 用户寄卖请求
     * result 1080
     */
    public function msgid_1051()
    {
        $data = $this->data;
        $data_UserSales = UserSalesReq::decode($data);
        var_dump($data_UserSales);
        $str = UserSalesResult::encode(1);
        $this->send(1080,$this->fd,$str);
    }

    /**
     * 存款请求 1047
     * return SavingGoldResult 1047
     */
    public  function msgid_1047()
    {
        $data = $this->data;
        $data_SavingGold = SavingGoldReq::decode($data);
        var_dump($data_SavingGold);
        //1 获取配置
        $GameConfig = new GameConfig();
        $arr_Interest = $GameConfig->getInterest();
        //2.判断用户背包数据是否足够
        $Bag = new Bag($this->uid);
        $count = $Bag->getCountByItemId($data_SavingGold['GoldType']);
        if($count >= $data_SavingGold['GoldCount']){
            //扣掉金币
            $rs = $Bag->delBag($data_SavingGold['GoldType'],$data_SavingGold['GoldCount']);
            if($rs){
                //存款输入数据
                $SavingGold = new SavingGold();
                $data_SavingGold['Uid'] = $this->uid;
                $data_SavingGold['SavingInst'] = $arr_Interest[$data_SavingGold['TimeLimit']];//利息
                $rs_id = $SavingGold->create($data_SavingGold);
                if($rs_id){
                    $str = SavingGoldResult::encode($rs_id);
                    $this->send(1047,$this->fd,$str);
                }else{
                    $this->send(1047,$this->fd,'','存款失败');
                }
            }
        }else{
            //金币不足
            $this->send(1047,$this->fd,'','没有足够的金钱');
        }

    }

    /**
     * 建造店铺
     * return 1058
     */
    public function msgid_1005()
    {
        $data = $this->data;
        $data_CreateBuild = CreateBuildReq::decode($data);
        $Shop = new CompanyShop();
        var_dump($data_CreateBuild);
        //*判断是否有公司
        $Company = new Company();
        $rs = $Company->getCompany($this->uid);
        if(!$rs){
            $this->send(1058,$this->fd,'','请先创建公司');
            return;
        }
        //1. 验证级别
        var_dump("验证级别");
        $rs = $Shop->CheckLevel($this->uid,$data_CreateBuild['ShopType']);
        if(!$rs){
            var_dump("级别不够");
            $this->send(1058,$this->fd,'','级别不够');
            return;
        }
        //2.验证金币是否满足
        var_dump("验证金币是否满足");
        $rs = $Shop->CheckMoney($this->uid,$data_CreateBuild['ShopType']);
        if(!$rs){
            var_dump("没有足够的金钱");
            $this->send(1058,$this->fd,'','没有足够的金钱');
            return;
        }
        $data_shop = $Shop->getShop($this->uid,$data_CreateBuild);
        if($data_shop){
            var_dump("店铺位置已经存在店铺");
        }else{
            $rs = $Shop->create($this->uid,$data_CreateBuild);
            var_dump("创建店铺");
            if($rs){
                $str = CreateBuildResult::encode($this->uid,$data_CreateBuild);
                $this->send(1058,$this->fd,$str);
            }
        }


    }

    /**
     * 获取客户端需要消耗的店铺id
     * return 1040
     */
    public function msgid_1040()
    {
        $data = $this->data;
        $data_Consume = ConsumeReq::decode($data);
        var_dump($data_Consume);
        $ConsumeResult = new ConsumeResult();
        foreach ($data_Consume as $item){
            $data_ConsumeResult = $ConsumeResult->getConsumeResult($this->uid,$item);
        }
        $str = \App\Protobuf\Result\ConsumeResult::encode($data_ConsumeResult);
        $this->send(1040,$this->fd,$str);
    }

    /**
     * 收取公共地图的金币
     * HarvestPublicShopReq
     * return 1197 收取公共地图的金币
     */
    public function msgid_1145()
    {
        $data = $this->data;
        $data_Harvest = HarvestPublicShopReq::decode($data);
        var_dump($data_Harvest);
        $ConsumeResult = new ConsumeResult();
        $list = [];
        $Shop = new \App\Models\Company\Shop();
        foreach ($data_Harvest as $ShopId) {
            var_dump("shopid:" . $ShopId);
            $data_ConsumeResult = $ConsumeResult->getConsumeResult($this->uid,$ShopId);
            $Shop->setPurchaseItmeDate($ShopId,$data_ConsumeResult['PurchaseItmeDate'],$data_ConsumeResult['OutputGoldDate']);//设置收获时间
            $list[] = $data_ConsumeResult;
        }
        $str = HarvestPublicShopResult::encode($list);
        $this->send(1197,$this->fd,$str);
    }
    /**
     * 加载所有员工
     * return 1118
     */
    public function msgid_1083()
    {
        $data = $this->data;
        $str = LoadStaffResult::encode($this->uid);
        $this->send(1118,$this->fd,$str);
    }

    /**
     * 招聘抽奖
     * return 1035
     */
    public function msgid_1082()
    {
        $data = $this->data;
        $data_RaffleFruits = RefStaffReq::decode($data);
        var_dump($data_RaffleFruits);
        $LottoLog = new LottoLog();
        $Lotto = new Lotto();
        $Time = $Lotto->getTime($data_RaffleFruits['TypeId']) * 60;
        //处理招聘抽奖
        //1抽奖时间是否符合
        $LastTime = $LottoLog->getLastTimeByType($this->uid,$data_RaffleFruits['TypeId']);
        var_dump("上次抽奖时间：");
        var_dump(date('Y-m-d H:i:s',$LastTime));
        var_dump("当前时间" . date('Y-m-d H:i:s'));
        var_dump("间隔时间"  . $Time);
        $TodayTime = strtotime(date('Y-m-d'));//今天0点时间戳 $TodayTime > $LastTime 第二天抽奖
        if(time()- $LastTime > $Time || ($TodayTime > $LastTime) ){
            var_dump("免费抽奖");
            $data_LottoLog['Uid'] = $this->uid;
            $data_LottoLog['Type'] = $data_RaffleFruits['TypeId'];
            $LottoLog->create($data_LottoLog);
            $IsFree = true;
        }else{
            var_dump("花钱抽奖");
            $IsFree = false;
        }
        //2是否有免费抽奖次数
        $num = $LottoLog->getNumByUid($this->uid,$data_RaffleFruits['TypeId']);

        $freenum = $Lotto->getDayFreeNum($data_RaffleFruits['TypeId']);
        if($freenum <= $num ){
            var_dump("招聘抽奖扣除金币");
            $IsFree = false;
        }
        if(!$IsFree){
            $data_money = $Lotto->getMoney($data_RaffleFruits['TypeId']);
            $Bag = new Bag($this->uid);
            $bag_count = $Bag->getCountByItemId($data_money['Type']);
            if($bag_count >= $data_money['Count']){
                $Bag->delBag($data_money['Type'],$data_money['Count']);
                //3随机员工
                $Staff = new Staff();
                $data_Staff = $Staff->createStaff($this->uid,$data_RaffleFruits['TypeId'],$IsFree);
                $str = RefStaffResult::encode($data_Staff);
                $this->send(1117,$this->fd,$str);
            }else{
                //没有足够的金钱
                $this->send(1142,$this->fd,'','没有足够的金钱');
                return;
            }
        }else{
            //3随机员工
            $Staff = new Staff();
            $data_Staff = $Staff->createStaff($this->uid,$data_RaffleFruits['TypeId'],$IsFree);
            $str = RefStaffResult::encode($data_Staff);
            $this->send(1117,$this->fd,$str);
        }

    }

    /**
     * 获取前台传来的铺id和人数是调入(0)还是调出(1)
     * retutn 1126
     */
    public function msgid_1091()
    {
        $data = $this->data;
        $data_ComeOutEmployee = ComeOutEmployeeReq::decode($data);
        var_dump($data_ComeOutEmployee);
        $Shop = new CompanyShop();
        $data_shop = $Shop->getInfoById($data_ComeOutEmployee['ShopId']);
        //设置对应员工id 对应的店铺id
        $Staff = new Staff();
        $rs = $Staff->setStaffShop($this->uid,$data_ComeOutEmployee);
        var_dump($rs);
        $str = ComeOutEmployeeResult::encode($data_ComeOutEmployee);
        $this->send(1126,$this->fd,$str);
    }

    /**
     * 获取人才市场列表
     * return 1176 GetTalentListResult
     */
    public function msgid_1130()
    {
//        GetTalentListReq
        $str = GetTalentListResult::encode($this->uid);
        $this->send(1176,$this->fd,$str);
    }

    /**
     * 升级店铺
     * return 1004
     */
    public function msgid_1018()
    {
        $data = $this->data;
        $data_BuildLvUp = BuildLvUpReq::decode($data);
        var_dump($data_BuildLvUp);
        $Shop = new CompanyShop();
        foreach ($data_BuildLvUp as $Id) {
            $data_Shop = $Shop->getInfoById($Id);
            $Level = $data_Shop['Level'];
            //1 验证金币是否满足
            $BuildingLevel = new BuildingLevel();
            $UpdateLevel = $Level + 1;
            $data_BuildingLevel = $BuildingLevel->getInfoByLevel($UpdateLevel);
            $UpgradeCost = $data_BuildingLevel['UpgradeCost'];//升级需要扣费
            //所需道具
            var_dump("所需道具$UpdateLevel".$data_BuildingLevel['NeedItems']);
            $data_NeedItems = $BuildingLevel->getNeedItems($data_BuildingLevel['NeedItems'],$data_Shop['ShopType']);
            $Bag = new Bag($this->uid);
            $bool = false;
            foreach ($data_NeedItems as $data_NeedItem) {
                $bool = $Bag->checkCountByItemId($data_NeedItem['ItemId'],$data_NeedItem['Count']);
                if(!$bool){
                    var_dump("道具数量不足" .$data_NeedItem['ItemId']. $data_NeedItem['Count']);
                    $this->send(1004,$this->fd,'','道具数量不足');
                    return;
                }
            }
            if($bool){
                $data_UpgradeCost = explode(',',$UpgradeCost);
                $Count = $Bag->getCountByItemId($data_UpgradeCost[0]);
                if($Count>= $data_UpgradeCost[1]){
                    //金币足够 执行升级动作
                    $rs = $Shop->UpdateLevel($Id,$data_BuildingLevel);
                    if($rs){
                        //扣除道具
                        foreach ($data_NeedItems as $data_NeedItem) {
                            $bool = $Bag->delBag($data_NeedItem['ItemId'],$data_NeedItem['Count']);
                            if(!$bool){
                                var_dump("道具数量不足1");
                                $this->send(1004,$this->fd,'','道具数量不足');
                                return;
                            }
                        }
                        $str = BuildLvUpResult::encode($Id);
                        $this->send(1004,$this->fd,$str);
                    }
                }else{
                    $this->send(1004,$this->fd,'','没有足够的金钱');
                }
            }else{
                return;
            }

        }

    }

    /**
     * 出售店铺
     * return DestoryBuildResult 1063
     */
    public function msgid_1010()
    {
        $data = $this->data;
        $DestoryBuildReq = DestoryBuildReq::decode($data);
        var_dump($DestoryBuildReq);
        //1. 查出店铺信息
        $Shop = new CompanyShop();
        $data_Shop = $Shop->getInfoById($DestoryBuildReq['Id']);
        if($data_Shop){
            //2 根据等级查询buildingLevel对应的数据
            $BuildingLevel = new BuildingLevel();
            $data_BuildingLevel = $BuildingLevel->getInfoByLevel($data_Shop['Level']);
            //3 返回金币 道具 扣除身价值
            $UpgradeCost = $data_BuildingLevel['UpgradeCost'];
            $res = explode(',',$UpgradeCost);
            $Bag = new Bag($this->uid);
            $Bag->addBag($res[0],$res[1]);//增加金币
            $NeedItems = $data_BuildingLevel['NeedItems'];//返回道具
            //扣除拆除费用
            $DismantleCost = $data_BuildingLevel['DismantleCost'];
            $res = explode(',',$DismantleCost);
            $Bag->delBag($res[0],$res[1]);//扣除拆除费用
            //删除店铺 ShopId 对应的Uid置空
            $rs = $Shop->ShopDismantle($DestoryBuildReq['Id'],$this->uid);
            if($rs){
                $str = DestoryBuildResult::encode($DestoryBuildReq['Id']);
                $this->send(1063,$this->fd,$str);
            }
        }else{
            //店铺不存在
        }
    }

    /**
     * 雇佣经理
     * return TalentHireResult 1177
     */
    public function msgid_1131()
    {
        $data = $this->data;
        $data_TalentHire = TalentHireReq::decode($data);
        var_dump($data_TalentHire);
        $Shop = new CompanyShop();
        //1计算雇佣费用
        $data_Money = $Shop->getMoneyToMaster($data_TalentHire['Uid']);
        //2判断金币是否足够
        $Bag = new Bag($this->uid);
        $count = $Bag->getCountByItemId(6);
        var_dump("gold===>" . $count);
        if($count >= $data_Money){
            $rs = $Shop->SetMaster($data_TalentHire['ShopId'],$data_TalentHire['Uid']);
            if($rs){
                var_dump("主管设置成功");
                //3扣除金币
                $Bag->delBag(6,$data_Money);
                //4 计算被雇佣奖励=>邮件发给用户
                $EmploymentAward = $Shop->EmploymentAward($data_Money);
                //执行发送邮件
            }
            $data_TalentHireResult['RoleId'] = $data_TalentHire['Uid'];
            $data_TalentHireResult['ShopId'] = $data_TalentHire['ShopId'];

            $data_TalentHireResult['Complete'] = true;//雇佣状态
            $str = TalentHireResult::encode($data_TalentHireResult);
            $this->send(1177,$this->fd,$str);
        }else{
            $this->send(1177,$this->fd,'','没有足够的金钱');
        }

    }

    /**
     * 刷新人才市场 TalentRefreshReq
     * return TalentRefreshResult 1182
     */
    public function msgid_1135()
    {
//        TalentRefreshReq
        $TalentMarketInfo = new TalentMarketInfo();
        $data_TalentMarketInfo = $TalentMarketInfo->getInfoByUid($this->uid);
        var_dump($data_TalentMarketInfo);
        if($data_TalentMarketInfo){
            //判断是免费刷新
            $data_TalentMarketTime = $TalentMarketInfo->getTalentMarketTime();
            $time = $data_TalentMarketTime['value'] * 60;

            if(time()-$data_TalentMarketInfo['LastTime'] > $time){
                //超过刷新时间免费
                $TalentMarketInfo->UpdateNum($data_TalentMarketInfo,true);
            }else{
                //扣费刷新 获取本次刷新价格
                $TalentMarketInfo->UpdateNum($data_TalentMarketInfo,false);
            }

        }else{
            $TalentMarketInfo->Create($this->uid);
        }
        var_dump('11111111111');
        $str = TalentRefreshResult::encode($this->uid);
        $this->send(1182,$this->fd,$str);
    }

    /**
     * 请求庄园
     */
    public function msgid_1053()
    {
        $data = RequestManorReq::decode($this->data);
        $land = new Land($this->uid);
        $landInfo = $land->getLand($data['userId']);
        $string = RequestManorResult::encode($landInfo);
        $this->send(1082,$this->fd,$string);
    }

    /**
     * 拜访记录
     * ManorVisitInfoResult
     */
    public function msgid_1148()
    {

        $land = new Land($this->uid);
        $res = $land->getLog();
        $string = ManorVisitInfoResult::encode($res);
        $this->send(1201,$this->fd,$string);

//        $this->send(1082,$this->fd,'');
    }

    /**
     * 购买种子商店
     */
    public function msgid_1076()
    {
        $data = SeedShopPingReq::decode($this->data);
        var_dump($data);
        $seed = new Seed($this->uid);
        $seedRes = $seed->buy($data['ItemId'],$data['ItemCount']);
        var_dump($seedRes);
        if (!isset($seedRes['error'])) {
            $string = SeedShopPingResult::encode($seedRes);
            $this->send(1108,$this->fd,$string);
        } else {
            $this->send(1108,$this->fd,'',$seedRes['msg'],12);
        }
    }
    /**
     * 解雇经理
     * return TalentFireResult 1178
     */
    public function msgid_1132()
    {
        $data = $this->data;
        $data_TalentFire = TalentFireReq::decode($data);
        var_dump($data_TalentFire);
        //1通过用户id查询被雇佣公司id 删除对应公司下的经理
        $Role = new Role();
        $data_role = $Role->getRole($data_TalentFire['RoleId']);
        $ShopId = $data_role['shopid'];
        //解雇操作
        $Shop = new CompanyShop();
        $rs = $Shop->FireMatser($ShopId);
        if($rs){
            $rs = $Role->setShopid($data_TalentFire['RoleId'],"");//设置用户被雇佣的店铺id为空
            if($rs){
                $str = TalentFireResult::encode($data_TalentFire['RoleId']);
                $this->send(1178,$this->fd,$str);
            }else{
                var_dump("解雇失败");
            }
        }
    }

    /**
     * 培训 培训员工
     * return CultivateEmployeeResult 1121
     */
    public function msgid_1086()
    {
        $data = $this->data;
        $data_CultivateEmployee = CultivateEmployeeReq::decode($data);
        var_dump($data_CultivateEmployee);
        //1 循环查询每个员工今日培训次数是多少 并判断是否已满
        $Staff = new Staff();
        $data_Staff = $Staff->getInfoByIds($data_CultivateEmployee);
        //配置每日限制次数
        $GameConfig = new GameConfig();
        $config = $GameConfig->getInfoByField('MaxTrainTime');//员工每天最大培训次数
        $MaxTrainTime = $config['value'];
        $Execl_Staff = new \App\Models\Excel\Staff();
        $arr = [];
        $Bag = new Bag($this->uid);
        $isTrue = true;
        $Train_sum = [];//培训需要钱的集合
        foreach ($data_Staff as $staff) {
            $data_Execl_Staff = $Execl_Staff->getInfoById($staff['NpcId']);
            $Comprehension = $data_Execl_Staff['Comprehension'];//最大培训次数
            $TrainNum = $staff['TrainNum']?:1;//培训次数
            $Quality = $staff['Quality'];//品质
            $TodayTrainNum = $staff['TodayTrainNum'];
            if($TrainNum >= $Comprehension ){
                var_dump("最大次数已达到不可培训");
                $this->send(1121,$this->fd,'','最大次数已达到不可培训');
                return;
                continue;
            }
            if($TodayTrainNum >= $MaxTrainTime ){
                var_dump("今日的培训次数到达上限");
                $this->send(1121,$this->fd,'','今日的培训次数到达上限');
                return;
                continue;
            }
            //2 根据次数判断花费 和对应身值
            $Train = new Train();
            $InfoByTrainNum = $Train->getInfoByTrainNum($TrainNum);
            $key = $TrainNum . '-' . $Quality;
            $data_money = $InfoByTrainNum[$key];
            $data_money['Type'];//类型
            $data_money['Count'];//数量


            //AttributeUp
            $AttributeUp = $data_Execl_Staff['AttributeUp'];
            $AttributeUps = explode(';',$AttributeUp);

            foreach ($AttributeUps as $item) {
                var_dump("AttributeUps");
                var_dump($item);
                $res = explode(',',$item);
                $res[0];//属性id
                $res[1];//min
                $res[2];//max
                mt_srand();

                $rand = mt_rand($res[1],$res[2]);
                $shuxing[$res[0]] = $rand;//属性值
            }
            var_dump("培训属性");
            var_dump($shuxing);
            //3计算总钱数是否满足
            $Train_sum[$data_money['Type']][] = $data_money['Count'];
            $count = $Bag->getCountByItemId($data_money['Type']);
            if( $count >= $data_money['Count'] ){
                //4.执行培训
                $rs = $Staff->setAttribute($staff,$shuxing);
                if(!$rs){
                    $isTrue = false;
                }else{
                    $Bag->delBag($data_money['Type'],$data_money['Count']);
                }
            }else{
                var_dump("金钱不足"  .$data_money['Type'] . "数量:" . $count . "需要" .  $data_money['Count']);
            }

        }
        if($isTrue){
            //培训成功
            $str = CultivateEmployeeResult::encode($data_CultivateEmployee);
            $this->send(1121,$this->fd,$str);
        }else{

        }
    }

    /**
     * GetMapReq
     * return GetMapResult 1064
     */
    public function msgid_1011()
    {
        $data = $this->data;
        $data_GetMap = GetMapReq::decode($data);
        var_dump($data_GetMap);
        //1查询所有地块
        $LandInfo = new LandInfo();
        $data_infopos = $LandInfo->getPosInfoByPoss($data_GetMap['Pos']);
        $str = GetMapResult::encode($this->uid,1,$data_infopos);//开发区
        $this->send(1064,$this->fd,$str);
    }

    /**
     * 获取所有无主店铺
     * NoBodyShopReq 1158,
     * return  NoBodyShopResult 1211
     */
    public function msgid_1158()
    {
        $data = $this->data;
        $data_NoBodyShop = NoBodyShopReq::decode($data);
        var_dump($data_NoBodyShop);
        $str = NoBodyShopResult::encode();
        $this->send(1211,$this->fd,$str);
    }


    /**
     * 贷款 LoansReq
     * return LoansResult 1205
     */
    public function msgid_1152()
    {
        $data = $this->data;
        $data_Loans = LoansReq::decde($data);
        var_dump($data_Loans);

        $LoansInfo = new LoansInfo();
        //0.验证是否有未还贷款
        $data_loans = $LoansInfo->getLoanByUid($this->uid);
        if($data_loans){
            $this->send(1205,$this->fd,'贷款中不能在申请贷款');
            return;
        }
        $GameConfig = new GameConfig();
        $data_PenaltyGold  = $GameConfig->getPenaltyGold();//贷款配置
        //1.验证是否可以贷款这么多钱
        $Role = new Role();
        $shenjiazhi = $Role->getShenjiazhi($this->uid);
        $Count = $shenjiazhi / 2 ;
        var_dump($shenjiazhi);
        if($Count >= 1000 && $Count >= $data_Loans['GoldCount']){

            $rs_id = $LoansInfo->create($data_Loans);
            if($rs_id){
                $str = LoansResult::encode($rs_id);
                $this->send(1205,$this->fd,$str);
            }
        }else{
            //不符合贷款要求
            $this->send(1205,$this->fd,'','身价值不足');
        }
    }

    /**
     * RoleAuctionShopReq 1140
     * return RoleAuctionShopResult 1189
     */
    public function msgid_1140()
    {
        $data = [];
        RoleAuctionShopResult::ecode($data);
    }

    /**
     * 今日土地竞拍请求 GetAuctionLandReq 2005
     * return GetAuctionLandResult 2006
     */
    public function msgid_2005()
    {
        var_dump("msgid2005");
        $str = GetAuctionLandResult::encode();
        $this->send(2006,$this->fd,$str);
    }

    /**
     * 竞拍土地请求 AuctionLandReq 2007
     * return AuctionLandResult 2008
     */
    public function msgid_2007()
    {
        $data = $this->data;
        $data_GetAuctionLand = AuctionLandReq::decode($data);
        var_dump($data_GetAuctionLand);
        $LandInfo = new LandInfo();
        //处理竞拍请求
        //0.查询已经竞拍数量
        $num = $LandInfo->getLandinfoNumByUid($this->uid);

        $Role = new Role();
        $data_level = $Role->getLevel($this->uid);
        $level = $data_level['level'];
        $limit_num = $LandInfo->getAuctionLandNums($level);
        var_dump("已竞拍数量:".$num . "最大数量" .$limit_num);
        if($num >= $limit_num){
            //限制
            $this->send(2008,$this->fd,'','AuctionLandTimesMax');
            return;
        }

        //1验证金币是否足够
        $config = $LandInfo->getBiddingPrice();

        $Bag = new Bag($this->uid);
        $count = $Bag->getCountByItemId($config['Type']);//土地对应类型的余额
        $new_count = $config['Count'];
        if($count >= $new_count){
            $create_data['Uid'] = $this->uid;
            $Role = new Role();
            $data_role = $Role->getRole($this->uid);
            $create_data['Name'] = $data_role['nickname'];
            $create_data['Pos'] = $data_GetAuctionLand['Pos'];
            $rs = $LandInfo->updateAuctionRole($create_data);

            if($rs){
                $str = AuctionLandResult::encode($data_GetAuctionLand['Pos']);
                $this->send(2008,$this->fd,$str);
            }else{
                var_dump("竞拍失败");
            }

        }else{
            $this->send(2008,$this->fd,'','没有足够的金钱');
        }

    }

    /**
     * 已参与竞拍
     * return MyLandInfoResult 2010
     */
    public function msgid_2009()
    {
        $data = MyLandInfoResult::encode($this->uid);
        $this->send(2010,$this->fd,$data);
    }

    /*
     * FruitsDataReq
     * return FruitsDataResult 1030
     */
    public function msgid_1031()
    {
        var_dump("msgid_1031");
        $str = FruitsDataResult::encode($this->uid);
        $this->send(1030,$this->fd,$str);
    }

    /**
     * 水果机请求
     * RaffleFruitsReq 1035
     * return 1035
     */
    public function msgid_1035()
    {
        //抽奖水果机
        $FruitsData = new FruitsData();
        $data_FruitsData = $FruitsData->getFruitsData(['Uid' => $this->uid]);
        var_dump($data_FruitsData);
        $is_false = [];
        $is_true = [];
        foreach ($data_FruitsData as $item) {
            if ($item['Status']) {
                $is_true[] = $item['FruitsId'];
            } else {
                $is_false[] = $item['FruitsId'];
            }
        }
        //1判断今日是否抽完
        if (count($is_false) == 0) {
            $this->send(1035, $this->fd, '', '今日均已抽完，请明日再来');
            return;
        }
        //2判断第几次是否需要扣费
        $count = count($is_true);
        $GameConfig = new GameConfig();
        $data_gameconfig = $GameConfig->getFruits();
        $data_price = $data_gameconfig[$count];

        $Bag = new Bag($this->uid);
        $gold = $Bag->getCountByItemId($data_price['Type']);
//        var_dump($data_price);
        if ($gold >= $data_price['Count']) {
            //3随机一个格子
//            扣费
            $rs = $Bag->delBag($data_price['Type'], $data_price['Count']);
            if ($rs) {
                mt_srand();
                $FruitsId = $FruitsData->getFruitsId($this->uid);
                var_dump($FruitsId);
                //设置redis 状态为Status = true
                $rs = $FruitsData->updateFruitsData($this->uid, $FruitsId);
                if ($rs) {
                    $rs = $Bag->addBag($data_FruitsData[$FruitsId]['ItemId'], $data_FruitsData[$FruitsId]['Count']);
                    if ($rs) {
                        $str = RaffleFruitsResult::encode($FruitsId);
                        $this->send(1035, $this->fd, $str);
                    } else {
                        var_dump("扣费失败");
                    }
                } else {
                    var_dump("updateFruitsData失败");
                }

            } else {
                var_dump("扣费失败");
            }

        } else {
            $this->send(1035, $this->fd, '', '没有足够的金钱');
        }
    }
    /*
     * 刷新土地状态
     */
    public function msgid_1104()
    {
        $data = RefFitnessReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->getlandOne($data['landId'],$data['uid']);
        if (isset($res['error'])) {
            $this->send(1143,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1143,$this->fd,RefFitnessResult::encode($res));
        }
    }

    /**
     * 升级土地
     */
    public function msgid_1125()
    {
        $data = UpgradeLandLevelReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->upgradeLand($data['landId']);
        if (isset($res['error'])) {
            $this->send(1171,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1171,$this->fd,UpgradeLandLevelResult::encode($res));
        }
    }

    /**
     * 施肥
     * return 2012
     */
    public function msgid_2011()
    {
        $data = UseCompostReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->useCompost($data['landId']);
        if (isset($res['error'])) {
            $this->send(2012,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(2012,$this->fd,UseCompostResult::encode($res));
        }
    }

    /**
     * 黑名单请求
     * return FriendAddBlackResult 1018
     */
    public function msgid_1026()
    {
        $data = $this->data;
        $data_FriendAddBlack = FriendAddBlackReq::decode($data);
        $FriendInfo = new FriendInfo();
        $rs = $FriendInfo->setBlackFriend($this->uid,$data_FriendAddBlack['RoleId']);
        $black_data = $FriendInfo->getFriendStatus($this->uid,$data_FriendAddBlack);
        $str = FriendAddBlackResult::encode($black_data[0]);
        $this->send(1018,$this->fd,$str);
    }

    /**
     * 交易行请求
     * SalesListReq
     * return SalesListResult 2016
     */
    public function msgid_2015()
    {
        $SalesItem = new SalesItem();
        $data = $SalesItem->getAll($this->uid);
        $str = SalesListResult::encode($data);
        $this->send(2016,$this->fd,$str);
    }

    /**
     * 寄卖请求
     * UserSalesReq
     * return UserSalesResult 2018
     */
    public function msgid_2017()
    {
        $data_UserSales = UserSalesReq::decode($this->data);
        //验证背包是否存在
        $Bag = new Bag($this->uid);
        $Count = $Bag->getCountByItemId($data_UserSales['ItemId']);
        if($Count >= $data_UserSales['Count']){
            //开始寄卖
            $SalesItem = new SalesItem();
            $insert = $data_UserSales;
            $insert['UpTime'] = time();
            $insert['Uid'] = $this->uid;
            //扣除道具
            $rs = $Bag->delBag($data_UserSales['ItemId'],$data_UserSales['Count']);
            if($rs){
                $Id = $SalesItem->create($insert);
                if($Id){
                    $insert['_id'] = (string)$Id;
                    $str = UserSalesResult::encode($insert);
                    $this->send(2018,$this->fd,$str);
                }else{
                    var_dump("寄卖失败");
                }
            }else{
                var_dump("删除道具失败");
            }
        }else{
            var_dump("道具数量不满足");
        }

    }

    /**
     * 交易行购买
     * UserBuyReq
     * return UserBuyResult 2020
     */
    public function msgid_2019()
    {
        $data_UserBuy = UserBuyReq::decode($this->data);
        //1验证数据存在不
        $SalesItem = new SalesItem();
        $info = $SalesItem->getInfoById($data_UserBuy['Id']);
        if($info>=$data_UserBuy['Count']){
            //2计算价格
            $count = $info['Price'] * abs($data_UserBuy['Count']);
            $Bag = new Bag($this->uid);
            $Count = $Bag->getCountByItemId($info['GoldType']);
            if($Count>= $count){
                //3.1执行购买
                $rs = $Bag->delBag($info['GoldType'],$count);//删除金币
                if($rs){
                    //3.2 扣除交易行
                    $rs = $SalesItem->ReduceSalesItem($data_UserBuy['Id'],$data_UserBuy['Count']);
                    if($rs){
                        $rs = $Bag->addBag($info['ItemId'],$data_UserBuy['Count']);//增加道具
                        if($rs){
                            $info['Count'] = $data_UserBuy['Count'];
                            $str = UserBuyResult::encode($info);
                            $this->send(2020,$this->fd,$str);
                        }else{
                            var_dump("购买失败");
                        }
                    }else{
                        var_dump("扣除交易行失败");
                    }

                }else{
                    var_dump("删除道具失败");
                }
            }else{
                var_dump("金币不足");
            }
        }else{
            var_dump("购买数量超出");
        }



    }

    /**
     * SoldOutReq
     * return SoldOutResult 2022
     */
    public function msgid_2021()
    {
        $data_SoldOut = SoldOutReq::decode($this->data);
        //下架
        //1 验证道具
        $SalesItem = new SalesItem();
        $info = $SalesItem->getInfoById($data_SoldOut['Id']);
        if($info){
            //2.1 下架
            $rs = $SalesItem->SoldOutById($data_SoldOut['Id']);
            if($rs){
                // 2.2 归还道具
                $Bag = new Bag($this->uid);
                $rs = $Bag->addBag($info['ItemId'],$info['Count']);
                if($rs){
                    $str = SoldOutResult::encode($data_SoldOut['Id']);
                    $this->send(2022,$this->fd,$str);
                }else{
                    var_dump("归还失败");
                }
            }else{
                var_dump("下架失败");
            }

        }else{
            var_dump("寄卖信息不存在");
        }
    }

    /**
     * 随机请求庄园
     */
    public function msgid_2013()
    {
        $land = new Land($this->uid);
        $res = $land->randLand();
        if (isset($res['error'])) {
            $this->send(2014,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(2014,$this->fd,RandManorResult::encode($res));
        }
    }

    /**
     * 获取自己上架的商品列表
     * return 1228
     */
    public function msgid_1168()
    {
        $SalesItem = new SalesItem();
        $data = $SalesItem->getAllByUid($this->uid);
        var_dump($data);
        $str = OnGetMyGoodsResult::ecode($data);
        $this->send(1228,$this->fd,$str);
    }

    /**
     * 邮件阅读请求
    * ReadMailReq
    * return 1114 ReadMailResult
     */
    public function msgid_1081()
    {
        $data = $this->data;
        $data_ReadMail = ReadMailReq::decode($data);
        var_dump($data_ReadMail);
        $Mail = new MailMsg();
        $Mail->setRead($this->uid,$data_ReadMail['Id']);

        //设置邮件为已读
        $str = ReadMailResult::encode($data_ReadMail['Id']);
        $this->send(1114, $this->fd, $str);
    }
    /*
     * 偷菜
     * return 1091
     */
    public function msgid_1061()
    {
        $data = StealSemenReq::decode($this->data);
        $land = new Land($this->uid);
        $res = $land->steal($data['uid'],$data['landIds']);

        if ($res == false) {
            $this->send(1091,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1091,$this->fd,StealSemenResult::encode($res));
        }
    }

    /**
     * 一键获取邮件物品
     * GetMailItemsReq
     * return 1095 GetMailItemsResult
     */
    public function msgid_1065()
    {
        $data = $this->data;
        $data_GetMailItems = GetMailItemsReq::decode($data);
        var_dump($data_GetMailItems);
        //获取邮件中的道具
        $Mail = new MailMsg();
        $data = $Mail->setRewardByIds($this->uid,$data_GetMailItems);
        $str = GetMailItemsResult::encode($data_GetMailItems);
        $this->send(1095,$this->fd,$str);

    }

    /**
     * 批量删除邮件
     *  DelMailsReq 1080
     * return 1113 DelMailsResult
     */
    public function msgid_1080()
    {
        $data = $this->data;
        $data_DelMails = DelMailsReq::decode($data);
        var_dump($data_DelMails);
        $Mail = new MailMsg();
        $rs = $Mail->DelRedisMail($this->uid,$data_DelMails);
        $str = DelMailsResult::encode($data_DelMails);
        $this->send(1113,$this->fd,$str);
    }

    /**
     * 移除黑名单 FriendRemoveBlackReq
     * return 1019 FriendRemoveBlackResult
     */
    public function msgid_1027()
    {
        $data = $this->data;
        $data_uid = FriendRemoveBlackReq::decode($data);
        $str = FriendRemoveBlackResult::encode($data_uid['Uid']);
        $this->send(1019,$this->fd,$str);
    }

    /**
     * 解雇员工
     * return 1122 DismissalEmployeeResult
     */
    public function msgid_1087()
    {
        $data = $this->data;

        $listId = DismissalEmployeeReq::decode($data);
        var_dump($listId);
        //删除员工
        $Staff = new Staff();
        $rs = $Staff->DelStaff($listId);
        if($rs){
            $str = DismissalEmployeeResult::encode($listId);
            $this->send(1122,$this->fd,$str);
        }else{
            var_dump("删除员工失败");
        }

    }

    /**
     * 签到请求
     * return 1168 签到返回
     */
    public function msgid_1121()
    {
        $str  = SignResult::encode($this->uid);
        $this->send(1168,$this->fd,$str);
    }

    /**
     * 请求
     */
    public function msgid_1042()
    {
        $data = RoomReq::decode($this->data);
        $room = new Room($data['uid']);
        $roomData = $room->getUseRoom();
        $string = RoomResult::encode($roomData);
        $this->send(1042,$this->fd,$string);
    }

    /**
     * todo::
     *家具升星
     */
    public function msgid_1109()
    {
        $data = FurnitureStarReq::decode($this->data);
        $room = new Room($this->uid);
        $res = $room->upgradeFurniture($data['id']);
        if (isset($res['error'])) {
            $this->send(1148,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1148,$this->fd,FurnitureStarResult::encode($res));
        }
    }
    /**
     * 签到请求
     * return DaySignResult 1169
     */
    public function msgid_1122()
    {
        $data = $this->data;
        $data_DaySign = DaySignReq::decode($data);
        var_dump($data_DaySign);
        //1判断是否是今天签到
        $day = date('d',time());
        //判断是否已经签到
        $SignInfo = new SignInfo();
        if(in_array($data_DaySign['Day'],[101,102,103,104])){
            //领取累计签到奖励
            //1 判断奖励是否领取
            $SignInfo = new SignInfo();
            $Info = $SignInfo->getRedisRewardByUid($this->uid);
            if(isset($Info[$data_DaySign['Day']])){
                //已经领取
                $this->send(1167,$this->fd,'','奖励已领取');
            }else{
                //领取奖励
                $TotalRewards = new TotalRewards();
                $D = [101=>7,102=>14,103=>21,104=>28];
                $list = $TotalRewards->getRewardByNeedDays($D[$data_DaySign['Day']]);
                if($list){
                    $Bag = new Bag($this->uid);
                    foreach ($list as $item) {
                        $rs = $Bag->addBag($item['ItemId'],$item['Count']);
                    }
                    $SignInfo->setRedisRewardByUid($this->uid,$data_DaySign['Day']);
                }
                $str = DaySignResult::encode(['Day'=>$data_DaySign['Day'],'IsSign'=>true]);
                $this->send(1169,$this->fd,$str);
                return;
            }
        }
        if($day == $data_DaySign['Day']){
            //今日签到
            $rs = $SignInfo->checkIsSign($this->uid,$data_DaySign['Day']);
            if(!$rs){
                $Sign = $SignInfo->setIsSignByUid($this->uid,$data_DaySign['Day']);
            }else{
                var_dump("今日已签到");
                return;
            }
        }else{
            //补签
            $GameConfig = new GameConfig();
            $data_price = $GameConfig->getSignGold();
            $Bag = new Bag($this->uid);
            $rs = $Bag->delBag(6,$data_price);
            if($rs){
                $Sign = $SignInfo->setIsSignByUid($this->uid,$data_DaySign['Day']);
            }else{
                var_dump("扣款失败");
                return;
            }
        }
        var_dump($Sign);
        if($Sign){
            //赠送道具
            $Excel_Sign = new Sign();
            $Reward = $Excel_Sign->getReward($data_DaySign['Day']);
            var_dump($Reward);
            if($Reward){
                $Bag = new Bag($this->uid);
                $rs = $Bag->addBag($Reward['ItemId'],$Reward['Count']);
                if(!$rs){
                    var_dump("签到赠送道具失败");
                }
            }else{
                var_dump("获取签到奖励失败");
            }
            //返回签到成功
            $str = DaySignResult::encode(['Day'=>$data_DaySign['Day'],'IsSign'=>true]);
            $this->send(1169,$this->fd,$str);
        }else{
            var_dump("签到失败");
            return;
        }

    }

    /**
     * 领取奖励
     * return 1167 PickUpSevenDaysResult
     */
    public function msgid_1120()
    {
        $data = $this->data;
        $data_day = PickUpSevenDaysReq::decode($data);
        var_dump($data_day);
        //1 判断奖励是否领取
        $SignInfo = new SignInfo();
        $Info = $SignInfo->getRedisRewardByUid($this->uid);
        if($Info[$data_day['Id']]){
            //已经领取
            $this->send(1167,$this->fd,'','奖励已领取');
        }else{
            //领取奖励
            $TotalRewards = new TotalRewards();
            $list = $TotalRewards->getRewardByNeedDays($data_day['Id']);
            if($list){
                $Bag = new Bag($this->uid);
                foreach ($list as $item) {
                    $rs = $Bag->addBag($item['ItemId'],$item['Count']);
                }
                $SignInfo->setRedisRewardByUid($this->uid,$data_day['Id']);
            }
            $str = PickUpSevenDaysResult::encode($data_day);
            $this->send(1167,$this->fd,$str);
        }
    }

    /**
     * 居民人脉列表 废弃
     * return 2024 NpcListResult
     */
    public function msgid_2023()
    {
        $data = $this->data;
        //处理居民npc逻辑
        //获取默认npc + 需要解锁npc
        $NpcInfo = new NpcInfo();
        $data = $NpcInfo->getRedisNpcList($this->uid);
        var_dump($data);
        $str = NpcListResult::encode($data);
        $this->send(2024,$this->fd,$str);
    }

    /**
     * 请求解锁npc
     * return 2026
     */
    public function msgid_2025()
    {
        $data = $this->data;
        $data_UnlockNpc = UnlockNpcReq::decode($data);
        var_dump($data_UnlockNpc);
        //处理解锁逻辑
        $Npc = new Npc();
        $Items = $Npc->getUnlockItemId($data_UnlockNpc['NpcId']);
        $Bag = new Bag($this->uid);
        $bool = false;
        foreach ($Items as $k =>$item) {
            $bool = $Bag->checkCountByItemId($k,$item);
            if(!$bool){
                //道具不满足
                $this->send(2026,$this->fd,'','道具数量不足');
                return;
            }
        }
        if($bool){
            foreach ($Items as $k=>$item) {
                $bool = $Bag->delBag($k,$item);
                if(!$bool){
                    var_dump("扣除道具失败");
                    $this->send(2026,$this->fd,'','道具数量不足');
                    return;
                }
            }
            if($bool){
                $NpcInfo = new NpcInfo();
                $rs = $NpcInfo->setRedisNpcUnlock($this->uid,$data_UnlockNpc['NpcId']);
                $str = UnlockNpcResult::encode($data_UnlockNpc['NpcId']);
                $this->send(2026,$this->fd,$str);
            }
        }else{
            var_dump("道具数量不足");
        }
    }

    /**
     * 居民委托任务
     * ResidentDelegateReq 1096
     * return 1134 ResidentDelegateResult
     */
    public function msgid_1096()
    {
        //委托任务
        $NpcTask = new NpcTask();
        $data_task = $NpcTask->getRedisTask($this->uid);
        var_dump($data_task);
        $str = ResidentDelegateResult::encode($data_task);
        $this->send(1134,$this->fd,$str);
    }

    /**
     * NpcFavorabilityReq
     * return 1037 NpcFavorabilityResult
     */
    public function msgid_1036()
    {
        $NpcInfo = new NpcInfo();
        $data = $NpcInfo->getRedisNpcList($this->uid);
        $str = NpcFavorabilityResult::encode($data);
        $this->send(1037,$this->fd,$str);
    }

    /**
     * 提升好感度
     * return 1133 AddNpcRelationAdvanceResult
     */
    public function msgid_1038()
    {
        $data = $this->data;
        $data_item = AddNpcRelationAdvanceReq::decode($data);
        var_dump($data_item);
        $Bag = new Bag($this->uid);
        $rs = $Bag->checkCountByItemId($data_item['ItemId'],$data_item['ItemCount']);
        if($rs){
            $rs = $Bag->delBag($data_item['ItemId'],$data_item['ItemCount']);
            if($rs){
                $Item = new Item();
                $data_iteminfo = $Item->getInfoById($data_item['ItemId']);
                $FavourValue = $data_iteminfo['FavourValue'];//好感度
                $NpcInfo = new NpcInfo();
                $rs = $NpcInfo->setRedisCurrentFavorability($this->uid,$data_item['NpcId'],$FavourValue);
                $data_NpcId_Info =$NpcInfo->getRedisInfoByUidNpcId($this->uid,$data_item['NpcId']);
                if($rs){
                   $str = AddNpcRelationAdvanceResult::encode($data_NpcId_Info);
                   $this->send(1133,$this->fd,$str);
                }else{
                    var_dump("赠送好感度失败");
                }
            }else{
                var_dump("删除背包失败");
            }
        }else{
            var_dump("道具数量不足");
        }
    }

    /**
     * 请求完成委托任务
     * AccomplishResidentDelegateReq
     * return 1135 AccomplishResidentDelegateResult
     */
    public function msgid_1098()
    {
        $data = $this->data;
        $data_Spot = AccomplishResidentDelegateReq::decode($data);
        //1判断是否有任务
        $NpcTask = new NpcTask();

        $data_task = $NpcTask->getRedisTask($this->uid);
        $Count = $data_task['Count'];
        var_dump("data_task");
        var_dump($data_Spot);
        var_dump($data_task);

        if($Count>=1){
            //判断剩余任务测试
            if( isset($data_task['NpcTask'][$data_Spot['Spot']]['TaskId']) ){
                //存在任务
                $ItemList = $data_task['NpcTask'][$data_Spot['Spot']]['ItemList'];
                //判断道具是否存在
                $Bag = new Bag($this->uid);
                $bool = false;
                foreach ($ItemList as $k => $item) {
                    $bool  = $Bag->checkCountByItemId($item['ItemId'],$item['Count']);
                    if(!$bool){
                        var_dump("道具不满足");
                        $this->send(1135,$this->fd,'','道具数量不足');
                        return;
                    }
                }
                var_dump($bool);
                if($bool){
                    //扣除道具
                    foreach ($ItemList as $k => $item) {
                        $rs = $Bag->delBag($item['ItemId'],$item['Count']);
                        if(!$rs){
                            var_dump("扣除道具失败");
                            return;
                        }
                    }
                    //增加奖励
                    $TaskId = $data_task['NpcTask'][$data_Spot['Spot']]['TaskId'];
                    $NpcId = $data_task['NpcTask'][$data_Spot['Spot']]['NpcId'];

                    $Entrust = new Entrust();
                    $data_Award = $Entrust->getAwardById($TaskId);

                    foreach ($data_Award as $k => $item) {
                        if($item['ItemId'] == 8){
                            //好感度 增加npc的好感度
                            $NpcInfo = new NpcInfo();
                            $rs = $NpcInfo->setRedisCurrentFavorability($this->uid,$NpcId,$item['Count']);
                            var_dump("设置好感度" . $rs);
                            if($rs){
                                //完成任务委托点
                                $data_newtask['Spot'] = $data_Spot['Spot'];
                                //生成新的任务委托点
                                $data_newtask = $NpcTask->UpdateTask($this->uid,$data_Spot['Spot']);
                                $str = AccomplishResidentDelegateResult::encode(['NpcTask'=>$data_newtask,'Spot'=>$data_Spot['Spot']]);
                                $this->send(1135,$this->fd,$str);
                            }else{
                                var_dump("增加好感度失败");
                            }
                        }else{
                            $Bag->addBag($item['ItemId'],$item['Count']);
                        }
                    }
                }
            }else{
                var_dump("不存在委托任务");
            }
        }else{
            var_dump("本回合任务已经完成");
        }

    }

    /**
     * 提升品质
     * NpcRelationAdvanceReq
     * return 1038 NpcRelationAdvanceResult
     */
    public function msgid_1037()
    {
        $data = $this->data;
        $data_Npc = NpcRelationAdvanceReq::decode($data);
        //提升品质
        //获取当前品质，获取升级品质好感度是否满足  获取升级品质道具是否满足
        $NpcInfo = new NpcInfo();
        $info = $NpcInfo->getRedisInfoByUidNpcId($this->uid,$data_Npc['NpcId']);
        $FavorabilityLevel = $info['FavorabilityLevel'];//品质
        $CurrentFavorability = $info['CurrentFavorability'];//好感度
        $Favour = new Favour();
        $Favour_Info = $Favour->getItem($data_Npc['NpcId'],$FavorabilityLevel);
        //判断好感度是否满足
        $Favour_Info['FriendValue'];
        if($CurrentFavorability >=$Favour_Info['FriendValue']){
            //判断道具是否满足
            $ItemList = $Favour_Info['ItemList'];
            $Bag = new Bag($this->uid);
            $bool = true;
            foreach ($ItemList as $k=>$item) {
                $bool = $Bag->checkCountByItemId($k,$item);
                if(!$bool){
                    $this->send(1038,$this->fd,'',"道具数量不足");
                    var_dump("道具不满足");
                    return;
                }
                if($bool ){
                    //道具满足
                    //扣除道具
                    foreach ($ItemList as $k=>$item) {
                        $rs = $Bag->delBag($k,$item);
                        if(!$rs){
                            var_dump("扣除道具失败");
                        }
                    }
                    //设置升级品质
                    $rs = $NpcInfo->setRedisUpdateFavorabilityLevel($this->uid,$data_Npc['NpcId']);
                    if($rs){
                        //升级成功 + 身价值
                        $Status = $Favour_Info['Status'];
                        $Role = new Role();
                        $rs = $Role->updateShenjiazhi($this->uid,$Status);
                        if($rs){
                            $info = $NpcInfo->getRedisInfoByUidNpcId($this->uid,$data_Npc['NpcId']);
                            $str = AddNpcRelationAdvanceResult::encode($info);
                            $this->send(1038,$this->fd,$str);
                        }else{
                            var_dump("身价值增加失败");
                        }
                    }
                }
            }
        }else{
            var_dump("好感度不满足");
            $this->send(1038,$this->fd,'','当前好感度不足，无法进阶');
        }
    }

    /**
     * 谈判团换任
     * TalkIngGroupChangeReq
     * return 1158 TalkIngGroupChangeResult
     */
    public function msgid_1114()
    {
        $data = $this->data;
        $data_TalkIng = TalkIngGroupChangeReq::decode($data);
        var_dump($data_TalkIng);
        //换人
        //把原来人置空 信任设置上
        $Staff = new Staff();
        $rs = $Staff->CancelAppointed($this->uid,$data_TalkIng['DownId']);
        if($rs){
            $rs = $Staff->setTalkGroupStaff($this->uid,$data_TalkIng['UpId']);
            if($rs){
                $str = TalkIngGroupChangeResult::ecode($data_TalkIng);
                $this->send(1158,$this->fd,$str);
            }else{
                var_dump("设置失败");
            }
        }

    }

    /**
     * 谈判团任命请求 TalkingGroupReq
     * return 1157 TalkingGroupResult
     */
    public function msgid_1115()
    {
        $data = $this->data;
        $data_TalkingGroup = TalkingGroupReq::decode($data);
        //判断是否替换
        $Replace = $data_TalkingGroup['Replace'];
        $Staff = new Staff();
        if($Replace){
            //替换原来谈判团员工
            $Staff_Down = $Staff->getTalkGroupStaffs($this->uid);
            $bool = $Staff->CancelAppointedAll($this->uid);

        }else{
            //无需替换
            $bool = true;
            $Staff_Down = [];
        }
        if($bool){
            $rs = $Staff->setTalkGroupStaffs($this->uid,$data_TalkingGroup['StaffId']);
            if($rs){
                $str = TalkingGroupResult::encode(['Ids'=>$data_TalkingGroup['StaffId'],'DownId'=>$Staff_Down]);
                $this->send(1157,$this->fd,$str);
            }else{
                var_dump("批量设置谈判团员工失败");
            }
        }else{
            var_dump("取消所有谈判团员工失败");
        }
    }

    /**
     * 购买住宅
     */
    public function msgid_1119()
    {
        $data = RoomUpdateReq::decode($this->data);
        $room = new Room($this->uid);
        $res = $room->buyRoom($data['roomId']);
        if (isset($res['error'])) {
            $this->send(1163,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1163,$this->fd,RoomUpdateResult::encode($res));
        }
    }

    /**
     * 住宅入住
     */
    public function msgid_1166()
    {
        $data = RoomLiveReq::deocode($this->data);
        $room = new Room($this->uid);
        $res = $room->setUseRoom($data['roomId']);
        if (isset($res['error'])) {
            $this->send(1226,$this->fd,'',$res['msg'],12);
        }  else {
            $this->send(1226,$this->fd,RoomLiveResult::encode($res));
        }
    }

    /**
     * 拜访住宅
     */
    public function msgid_1046()
    {
        $data = RoomVisitReq::decode($this->data);
        $room = new Room($this->uid);
        $res = $room->visitRoom($this->uid,$data['uid']);
        $this->send(1046,$this->fd,RoomVisitResult::encode($res));

    }

    /**
     * 获取住宅日志
     */
    public function msgid_1059()
    {
        $room = new Room($this->uid);
        $log = $room->getLog();
        $string = RoomVisitInfoResult::encode($log);
        $this->send(1087,$this->fd,$string);
    }

    /**
     * pk排行榜
     * return 2028 PkRankingResult
     */
    public  function msgid_2027()
    {
        //查询排行榜前10名和自己排名
        $PkInfo = new PkInfo();
        $data = $PkInfo->getRanking($this->uid);
        $Count = 1;
        $str = PkRankingResult::encode($data,$Count);
        $this->send(2028,$this->fd,$str);
    }

    /**
     * 请求排行榜
     * return 1132
     */
    public function msgid_1094()
    {
        $data = RankingReq::decode($this->data);
        $rankList = new RankList();
        $res = $rankList->getData($data['ranKingType']);
        $this->send(1132,$this->fd,RankingResult::encode($res,$data['ranKingType']));
    }

    /**
     * 获得个人排行榜
     */
    public function msgid_1095()
    {
        $this->send(1131,$this->fd,GetRankingResult::encode(1));
    }

    /**
     * 修改签名请求
     * return 2030 SignNameResult
     */
    public function msgid_2029()
    {
        $data = $this->data;
        $data_SignName = SignNameReq::decode($data);
        var_dump($data_SignName);
        //修改签名
        $Role = new Role();
        $rs = $Role->updateSignName($this->uid,$data_SignName['Desc']);
        if($rs){
            $str = SignNameResult::encode($data_SignName['Desc']);
            $this->send(2030,$this->fd,$str);
        }else{
            var_dump("修改个性签名失败");
        }

    }

    /**
     * 谈判团居民任命
     * return 2032 TalkingGroupResidentResult
     */
    public function msgid_2031()
    {
        $data = $this->data;
        $data_Resident = TalkingGroupResidentReq::decode($data);
        //换下来的居民
        $NpcInfo = new NpcInfo();
        if($data_Resident['Replace']){
            $DownId = $NpcInfo->getRedisNpcAppointed($this->uid);
        }else{
            $DownId = [];
        }

        //换人
        $rs = $NpcInfo->CancelAppointedAll($this->uid,$DownId);

        $rs = $NpcInfo->setRedisNpcAppointed($this->uid,$data_Resident['Ids']);
        if($rs){
            $str = TalkingGroupResidentResult::encode(['Ids'=>$data_Resident['Ids'],'DownId'=>$DownId]);
            $this->send(2032,$this->fd,$str);
        }else{
            var_dump("设置团判团居民失败");
        }
    }

    /**
     * 更改居民
     * return 2034 TalkIngGroupResidentChangeResult
     */
    public function msgid_2033()
    {
        $data = $this->data;
        $data_Resident = TalkIngGroupResidentChangeReq::decode($data);
        //更改
        $NpnInfo = new NpcInfo();
        $rs = $NpnInfo->CancelAppointedAll($this->uid,[$data_Resident['DownId']]);
        $rs = $NpnInfo->setRedisNpcAppointed($this->uid,[$data_Resident['UpId']]);
        if($rs){
            $str = TalkIngGroupResidentChangeResult::encode($data);
            $this->send(2034,$this->fd,$str);
        }else{
            var_dump("设置任职失败");
        }

    }

}
