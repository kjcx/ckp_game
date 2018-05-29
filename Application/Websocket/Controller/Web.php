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
use App\Models\BagInfo\Bag;
use App\Models\Company\Company;
use App\Models\Company\ConsumeResult;
use App\Models\Company\Shop as CompanyShop;
use App\Models\Company\TalentMarketInfo;
use App\Models\Execl\BuildingLevel;
use App\Models\Execl\GameConfig;
use App\Models\Execl\Lotto;
use App\Models\Execl\Topup;
use App\Models\Execl\Train;
use App\Models\Execl\WsResult;
use App\Models\Item\Item;
use App\Models\Manor\Land;
use App\Models\Staff\LottoLog;
use App\Models\Staff\Staff;
use App\Models\Store\Seed;
use App\Models\Trade\Shop;
use App\Models\User\Account;
use App\Models\User\FriendApply;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;
use App\Protobuf\Req\BuildLvUpReq;
use App\Protobuf\Req\ChangeAvatarReq;
use App\Protobuf\Req\ChatToChatReq;
use App\Protobuf\Req\CKApiReq;
use App\Protobuf\Req\ComeOutEmployeeReq;
use App\Protobuf\Req\ConsumeReq;
use App\Protobuf\Req\CreateBuildReq;
use App\Protobuf\Req\CreateCompanyReq;
use App\Protobuf\Req\CultivateEmployeeReq;
use App\Protobuf\Req\DestoryBuildReq;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\FriendAddReq;
use App\Protobuf\Req\FriendApplyClearReq;
use App\Protobuf\Req\FriendApplyReq;
use App\Protobuf\Req\FriendRemoveReq;
use App\Protobuf\Req\FriendSearchReq;
use App\Protobuf\Req\GetMapReq;
use App\Protobuf\Req\GetPraiseRoleIdReq;
use App\Protobuf\Req\MoneyChangeReq;
use App\Protobuf\Req\NoBodyShopReq;
use App\Protobuf\Req\RaffleFruitsReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\RefStaffReq;
use App\Protobuf\Req\RequestManorReq;
use App\Protobuf\Req\SavingGoldReq;
use App\Protobuf\Req\SeedShopPingReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Req\TalentFireReq;
use App\Protobuf\Req\TalentHireReq;
use App\Protobuf\Req\TopUpGoldReq;
use App\Protobuf\Req\UpdateRoleInfoNameReq;
use App\Protobuf\Req\UseItemReq;
use App\Protobuf\Req\UserSalesReq;
use App\Protobuf\Result\BuildLvUpResult;
use App\Protobuf\Result\ChangeAvatarResult;
use App\Protobuf\Result\ChatToChatResult;
use App\Protobuf\Result\CkPayResult;
use App\Protobuf\Result\ComeOutEmployeeResult;
use App\Protobuf\Result\CreateBuildResult;
use App\Protobuf\Result\CreateCompanyResult;
use App\Protobuf\Result\CultivateEmployeeResult;
use App\Protobuf\Result\DestoryBuildResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\FriendAddResult;
use App\Protobuf\Result\FriendApplyClearResult;
use App\Protobuf\Result\FriendApplyResult;
use App\Protobuf\Result\FriendRemoveResult;
use App\Protobuf\Result\FriendSearchResult;
use App\Protobuf\Result\GetMapResult;
use App\Protobuf\Result\GetPraiseRoleIdResult;
use App\Protobuf\Result\GetTalentListResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\LoadStaffResult;
use App\Protobuf\Result\ManorVisitInfoResult;
use App\Protobuf\Result\MissionFirstCompleteResult;
use App\Protobuf\Result\ModelClothesResult;
use App\Protobuf\Result\MoneyChangeResult;
use App\Protobuf\Result\NoBodyShopResult;
use App\Protobuf\Result\RaffleFruitsResult;
use App\Protobuf\Result\RefDropShopResult;
use App\Protobuf\Result\RefStaffResult;
use App\Protobuf\Result\RequestManorResult;
use App\Protobuf\Result\SavingGoldResult;
use App\Protobuf\Result\ScoreShopResult;
use App\Protobuf\Result\SeedShopPingResult;
use App\Protobuf\Result\SellItemResult;
use App\Protobuf\Result\TalentFireResult;
use App\Protobuf\Result\TalentHireResult;
use App\Protobuf\Result\TalentInfo;
use App\Protobuf\Result\TalentRefreshResult;
use App\Protobuf\Result\TopUpGoldResult;
use App\Protobuf\Result\UpdateRoleInfoIconResult;
use App\Protobuf\Result\UpdateRoleInfoNameResult;
use App\Protobuf\Result\UseItemResult;
use App\Protobuf\Result\UserSalesResult;
use EasySwoole\Core\Component\Spl\SplStream;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Socket\Client\WebSocket;
use EasySwoole\Core\Socket\Common\CommandBean;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Db;

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
        var_dump($msgid);
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
        $dataCenter = new DataCenter();
        $fds = $dataCenter->getMyFd(); //获取我所有的Fd
        var_dump($fds);
        foreach ($fds as $fd) {
            $massTemplate = new Mass(['fd' => $fd,'data' => 11,]);
            TaskManager::async($massTemplate);
        }
//        $this->response()->write();
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
            $dataCenter->saveClient($this->fd,$uid);
            //登录成功
            $data = \App\Protobuf\Result\ConnectingResult::encode($uid);
           $this->send(1057,$this->fd,$data);
        }else{
            var_dump("用户不存在");
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
        var_dump("joingame_start:" . microtime(true));

        var_dump('msgid_1012');
        //加入游戏
        var_dump($this->uid);
        $data = JoinGameResult::encode(['uid'=>$this->uid]);
        $this->send(1066,$this->fd,$data);
        var_dump("joingame_end:" . microtime(true));

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
        var_dump($data_SellItemReq);
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
            var_dump("====异常=====");
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
        var_dump("mgsid_1102");
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
        $data_pay = CKApiReq::decode($this->data);
        var_dump($data_pay);
        $Id = $data_pay['PayParams']['Id'];
        $Pwd = $data_pay['PayParams']['Pwd'];
        //获取充值的id
        $Topup = new Topup();
        $data_Topup = $Topup->findById($Id);
        var_dump($data_Topup);
        //判断app余额是否足够
        $Account = new Account();
        $res = $Account->payByApp($this->uid,$data_Topup['Gold'],$Pwd,'game_recharge');
        if($res['code'] == 200){
            //充值成功
            //背包金额增加
            $rolebag = new RoleBag();
            $Bag = new Bag($this->uid);
            $Bag->addBag(2,$data_Topup['Gold']);
            //返回充值成功
            $data  = CkPayResult::encode(true);
            $this->send(1224,$this->fd,$data);
        }else{
            //充值失败
            $data  = CkPayResult::encode(false);
            $WsResult = new WsResult();
            if($res['datas']['error'] == '您输入的密码有误'){
//                $data_ws = $WsResult->getOne('APP支付密码不对');
                $this->send(1224,$this->fd,$data,'APP支付密码不对');
            }elseif ($res['datas']['error'] == '余额不足！！！'){
//                $data_ws = $WsResult->getOne('APP余额不足');
                $this->send(1224,$this->fd,$data,'APP余额不足');
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
        var_dump($data_MoneyChange);
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
        var_dump($data_TopUpGold);
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
        var_dump($data_UpdateRoleInfoName);//

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
        var_dump($data);
        $data_send_msg = \App\Protobuf\Req\SendMsgToChannelReq::decode($data);
        var_dump($data_send_msg);
    }

    /**
     * 快速完成任务
     */
    public function msgid_1149()
    {
        $data = $this->data;
        $data_MissionId = \App\Protobuf\Req\MissionFirstCompleteReq::decode($data);
        var_dump($data_MissionId);
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
        var_dump($data_UseItem);
        $Bag = new Bag($this->uid);
        //0.验证是否有此道具
        $data_bag = $Bag->checkBagHasItemById($data_UseItem['ItemId']);
        $data_bag['CurCount'] = 10;
        if($data_bag){
            if ($data_bag['CurCount'] >= $data_UseItem['Count']){
                //1 获取礼包规则
                $Item = new Item();
                $data_item = $Item->getItemUseEffetById($data_UseItem);
                //2 使用礼包

                $bool = false;
                $ids[] = $data_UseItem['ItemId'];
                foreach ($data_item as $v) {
                    $item_count[$v['Id']] = $v['CurCount'];
                    $bool = $Bag->addBag($v['Id'],$v['CurCount']);
                    $ids[] =  $v['Id'];
                }
                var_dump('使用礼包');
                var_dump($bool);
                if($bool){
                    //使用成功 扣除礼包
                    $rs = $Bag->delBag($data_UseItem['ItemId'],$data_UseItem['Count']);
                    var_dump('使用成功 扣除礼包');
                    var_dump($ids);
                    if($rs){
                        $ids[] =  $data_UseItem['ItemId'];
                        $str = UseItemResult::encode($this->uid,$item_count);
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
                    $str = CreateCompanyResult::encode($this->uid);
                    $this->send(1059,$this->fd,$str);
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
        $role = new Role();
        $arr = $role->SearchFriend($this->uid,$data_FriendSearch);
        var_dump($arr);
        $str = FriendSearchResult::encode($arr);
        $this->send(1016,$this->fd,$str);
    }

    /**
     * 申请加好友
     */
    public function msgid_1021()
    {
        $data = $this->data;
        $data_FriendApply = FriendApplyReq::decode($data);
        var_dump($data_FriendApply);
        $str = FriendApplyResult::encode($data_FriendApply,$this->uid);
        $this->send(1011,$this->fd,$str);
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
        $FriendApply = new FriendApply();
        $bool = $FriendApply->passFriendApply($this->uid,$data_FriendAdd);
        if($bool){
            $str = FriendAddResult::encode($bool);
            $this->send(1013,$this->fd,$str);
        }else{

        }

    }

    /**
     * 拒绝用户申请
     */
    public function msgid_1025()
    {
        $data = $this->data;
        $data_FriendApplyClear = FriendApplyClearReq::decode($data);
        $str = FriendApplyClearResult::encode($data);
        $this->send(1017,$this->fd,$str);
    }

    /**
     * 删除好友
     */
    public function msgid_1023()
    {
        $data = $this->data;
        $data_FriendRemove = FriendRemoveReq::decode($data);
        var_dump($data_FriendRemove);
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
     * 存款请求
     * return 1047
     */
    public  function msgid_1047()
    {
        $data = $this->data;
        $data_SavingGold = SavingGoldReq::decode($data);
        var_dump($data_SavingGold);
        $GameConfig = new GameConfig();
        $data_GameConfig = $GameConfig->getInfoByField('Interest');
        var_dump($data_GameConfig['value']);
        explode(';',$data_GameConfig['value']);
        $str = SavingGoldResult::encode(1);
        $this->send(1047,$this->fd,$str);
    }

    /**
     * 建造店铺
     * return 1058
     */
    public function msgid_1005()
    {
        $data = $this->data;
        $data_CreateBuild = CreateBuildReq::decode($data);
        var_dump($data_CreateBuild);
        //1. 验证级别
        $Shop = new CompanyShop();
        $rs = $Shop->CheckLevel($this->uid,$data_CreateBuild['ShopType']);
        if(!$rs){
            var_dump("级别不够");
            $this->send(1058,$this->fd,'','级别不够');
            return;
        }
        //2.验证金币是否满足
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
        $data_ConsumeResult = $ConsumeResult->getConsumeResult($this->uid);
        $str = \App\Protobuf\Result\ConsumeResult::encode($data_ConsumeResult);
        $this->send(1040,$this->fd,$str);
    }

    /**
     * 加载所有员工
     * return 1118
     */
    public function msgid_1083()
    {
        $data = $this->data;
        $str = LoadStaffResult::encode($this->uid);
        var_dump($str);
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
            $UpgradeCost = $data_BuildingLevel['UpgradeCost'];
            $data_UpgradeCost = explode(',',$UpgradeCost);
            $Bag = new Bag($this->uid);
            $Count = $Bag->getCountByItemId($data_UpgradeCost[0]);
            if($Count>= $data_UpgradeCost[1]){
                //金币足够 执行升级动作
                $rs = $Shop->UpdateLevel($Id,$data_BuildingLevel);
                if($rs){
                    $str = BuildLvUpResult::encode($this->uid);
                    $this->send(1004,$this->fd,$str);
                }
            }else{
                $this->send(1004,$this->fd,'','没有足够的金钱');
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
     *
     * 请求庄园
     */
    public function msgid_1053()
    {
        $data = RequestManorReq::decode($this->data);
        $land = new Land($this->uid);
        $landInfo = $land->getLand();
        $string = RequestManorResult::encode($landInfo);
        $this->send(1082,$this->fd,$string);
    }

    /**
     * 拜访记录
     * TODO::init
     * ManorVisitInfoResult
     */
    public function msgid_1148()
    {
        $data = [];
        $string = ManorVisitInfoResult::encode();
        $this->send(1201,$this->fd,$string);

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
        $Execl_Staff = new \App\Models\Execl\Staff();
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
        $str = GetMapResult::encode($this->uid,2);//开发区
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

}