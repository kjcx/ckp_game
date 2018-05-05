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
use App\Event\SellItemEvent;
use App\Models\BagInfo\Bag;
use App\Models\Execl\Topup;
use App\Models\Execl\WsResult;
use App\Models\Item\Item;
use App\Models\Trade\Shop;
use App\Models\User\Account;
use App\Models\User\FriendApply;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;
use App\Protobuf\Req\ChangeAvatarReq;
use App\Protobuf\Req\ChatToChatReq;
use App\Protobuf\Req\CKApiReq;
use App\Protobuf\Req\CreateCompanyReq;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\FriendAddReq;
use App\Protobuf\Req\FriendApplyClearReq;
use App\Protobuf\Req\FriendApplyReq;
use App\Protobuf\Req\FriendRemoveReq;
use App\Protobuf\Req\FriendSearchReq;
use App\Protobuf\Req\GetPraiseRoleIdReq;
use App\Protobuf\Req\MoneyChangeReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\SavingGoldReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Req\TopUpGoldReq;
use App\Protobuf\Req\UpdateRoleInfoNameReq;
use App\Protobuf\Req\UseItemReq;
use App\Protobuf\Req\UserSalesReq;
use App\Protobuf\Result\ChangeAvatarResult;
use App\Protobuf\Result\ChatToChatResult;
use App\Protobuf\Result\CkPayResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\FriendAddResult;
use App\Protobuf\Result\FriendApplyClearResult;
use App\Protobuf\Result\FriendApplyResult;
use App\Protobuf\Result\FriendRemoveResult;
use App\Protobuf\Result\FriendSearchResult;
use App\Protobuf\Result\GetPraiseRoleIdResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\MissionFirstCompleteResult;
use App\Protobuf\Result\ModelClothesResult;
use App\Protobuf\Result\MoneyChangeResult;
use App\Protobuf\Result\RefDropShopResult;
use App\Protobuf\Result\SavingGoldResult;
use App\Protobuf\Result\ScoreShopResult;
use App\Protobuf\Result\SellItemResult;
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
        $str  = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data,$Result,$ErrorMsg);
        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);

    }
    /**
     * 登录websocket服务器
     * 消息id 1004
     */
    public function msgid_1004()
    {
        var_dump('msgid_1004');
        $Data = $this->data;
        $token = \App\Protobuf\Req\ConnectingReq::decode($Data);
        //redis查询token是否存在
        $Account = new Account();
        $uid = $Account->getToken($token);
        var_dump($uid);
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
        var_dump('msgid_1012');
        //加入游戏
        var_dump($this->uid);
        $data = JoinGameResult::encode(['uid'=>$this->uid]);
        $this->send(1066,$this->fd,$data);

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
        $RoleBag = new RoleBag();

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
            $res = Db::table('WsResult')->where(['msg'=>'没有足够的金钱'])->find();
            var_dump($res);
            $this->send(1203,$this->fd,0,$res['value'],$res['msg']);
        }
    }

    /**
     * 购买种子商店请求
     */
    public function msgid_1076()
    {

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
            $Bag->delBag(2,$data_Topup['Gold']);
            //返回充值成功
            $data  = CkPayResult::encode(true);
            $this->send(1224,$this->fd,$data);
        }else{
            //充值失败
            $data  = CkPayResult::encode(false);
            $this->send(1224,$this->fd,$data);
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
                $WsResult = new WsResult();
                $data_ws = $WsResult->getOne('角色名已经存在');
                $str  = \App\Protobuf\Result\MsgBaseSend::encode(1060,$data,$data_ws['value']);
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
            $WsResult = new WsResult();
            $data_ws = $WsResult->getOne('没有足够的金钱');
            $this->send(1142,$this->fd,'',$data_ws['value']);
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
                $WsResult = new WsResult();
                $data_ws = $WsResult->getOne('道具数量不足');
                $this->send(1078,$this->fd,'',$data_ws['value']);
            }
        }else{
            //道具不存在
            $WsResult = new WsResult();
            $data_ws = $WsResult->getOne('背包中没有该道具');
            $this->send(1078,$this->fd,'',$data_ws['value']);
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
        var_dump($data_Create);
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
        $str = SavingGoldResult::encode(1);
        $this->send(1047,$this->fd,$str);
    }
}