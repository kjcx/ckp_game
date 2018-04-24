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
use App\Event\ItemResultEvent;
use App\Event\ChangeItemSubscriber;
use App\Event\SellItemEvent;
use App\Models\Execl\Topup;
use App\Models\Item\Item;
use App\Models\Trade\Shop;
use App\Models\User\Account;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;
use App\Protobuf\Req\ChangeAvatarReq;
use App\Protobuf\Req\CKApiReq;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\MoneyChangeReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Req\TopUpGoldReq;
use App\Protobuf\Req\UpdateRoleInfoNameReq;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\ChangeAvatarResult;
use App\Protobuf\Result\CkPayResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\MissionFirstCompleteResult;
use App\Protobuf\Result\ModelClothesResult;
use App\Protobuf\Result\MoneyChangeResult;
use App\Protobuf\Result\RefDropShopResult;
use App\Protobuf\Result\ScoreShopResult;
use App\Protobuf\Result\SellItemResult;
use App\Protobuf\Result\TopUpGoldResult;
use App\Protobuf\Result\UpdateRoleInfoIconResult;
use App\Protobuf\Result\UpdateRoleInfoNameResult;
use AutoMsg\MissionFirstCompleteReq;
use AutoMsg\SendMsgToChannelReq;
use EasySwoole\Core\Component\Spl\SplStream;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Socket\Client\WebSocket;
use EasySwoole\Core\Socket\Common\CommandBean;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;
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
        $RoleBag = new RoleBag();
        $RoleBag->updateRoleBag($this->uid,['id'=>$ItemId,'CurCount'=>9]);
        $data = DropShopPingResult::encode($data_DropShopPingReq);
        $this->send(1107,$this->fd,$data);

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
        $data = \App\Protobuf\Result\ShopAllResult::encode();
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
            $RoleBag = new RoleBag();
            foreach ($PriceType as $k => $v) {
                $update_bag1 = ['id'=>$k,'CurCount'=>$v];//金币增加
                $update_bag2 = ['id'=>$data_SellItemReq['ItemId'],'CurCount'=>(-1)*$data_SellItemReq['Count']];//道具数量减少
                $RoleBag->updateRoleBag($this->uid,$update_bag1);
                $RoleBag->updateRoleBag($this->uid,$update_bag2);
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
        $data = ScoreShopResult::encode();
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
            foreach ($item_ids as $id) {
                $RoleBag->updateRoleBag($this->uid,['id'=>$id,'CurCount'=>1]);
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
            $rolebag->updateRoleBag($this->uid,['id'=>2,'CurCount'=>$data_Topup['Gold']]);
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

    public function msgid_1103()
    {
        $data = $this->data;
        $data_UpdateRoleInfoName = UpdateRoleInfoNameReq::decode($data);
        var_dump($data_UpdateRoleInfoName);//
        //修改角色名字
        $role = new Role();
        $rs = $role->updateRoleName($this->uid,$data_UpdateRoleInfoName['RoleName']);
        if($rs){
            //昵称修改成功
            $str = UpdateRoleInfoNameResult::encode($data_UpdateRoleInfoName['RoleName']);
            $this->send(1142,$this->fd,$str);
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
        //任务id
        $str = MissionFirstCompleteResult::encode($data_MissionId);
        $this->send(1202,$this->fd,$str);
    }
}