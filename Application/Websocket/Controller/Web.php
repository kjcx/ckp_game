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
use App\Event\ItemEvent;
use App\Event\ItemResultEvent;
use App\Event\ChangeItemSubscriber;
use App\Event\SellItemEvent;
use App\Models\Item\Item;
use App\Models\Trade\Shop;
use App\Models\User\Account;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Models\User\UserAttr;
use App\Protobuf\Req\ChangeAvatarReq;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\ModelClothesResult;
use App\Protobuf\Result\RefDropShopResult;
use App\Protobuf\Result\ScoreShopResult;
use App\Protobuf\Result\SellItemResult;
use App\Protobuf\Result\UpdateRoleInfoIconResult;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Db;

class Web extends WebSocketController
{
    public $data;

    function actionNotFound(?string $actionName)
    {

        parent::actionNotFound($actionName); // TODO: Change the autogenerated stub
        $arr = \App\Protobuf\Result\MsgBaseRev::decode($this->client()->getData());
    var_dump(11111111);
        $MsgId = $arr['MsgId'];
        var_dump($MsgId);
        $Data = $arr['Data'];
        if($MsgId == 1004){

        }elseif ($MsgId == 1007){
            $create_req_data = \App\Protobuf\Req\CreateRoleReq::decode($Data);
            $data = ['uid'=>2,'nickname'=>$create_req_data['Name'],'sex'=>$create_req_data['Sex'],'status'=>1,'create_time'=>time()];
            $Role = new Role();
            $rs = $Role->createRole($data);
            if($rs){
                //角色创建成功
                $data = \App\Protobuf\Result\CreateRoleResult::encode($create_req_data);
                $str  = \App\Protobuf\Result\MsgBaseSend::encode(1060,$data);
                ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            }else{
                //角色创建失败
            }
        }elseif ($MsgId == 1012){
            //加入游戏
            $uid = 2;
            $data = JoinGameResult::encode(['uid'=>$uid]);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1066,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        }elseif ($MsgId == 1077){
            //刷新商品商店
            $shopType = RefDropShopReq::decode($Data);
            $str = RefDropShopResult::encode($shopType);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        }elseif ($MsgId == 1075){
            //掉落库商品购买
            $data_DropShopPingReq = DropShopPingReq::encode($Data);
            var_dump($data_DropShopPingReq);
            $ShopTypeId = $data_DropShopPingReq['ShopTypeId'];
            $ItemId = $data_DropShopPingReq['ItemId'];
            $DropKuId = $data_DropShopPingReq['DropKuId'];
            $GridId = $data_DropShopPingReq['GridId'];
            $RoleBag = new RoleBag();
            $RoleBag->updateRoleBag(2,['id'=>$ItemId,'CurCount'=>99]);

            $data = DropShopPingResult::encode($data_DropShopPingReq);

            $str = \App\Protobuf\Result\MsgBaseSend::encode(1107,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            $data = AddItemResult::encode(2);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1053,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);

            //返回结果
        }elseif ($MsgId == 1106){
            //请求加载商店
            $data = \App\Protobuf\Result\ShopAllResult::encode();
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1145,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        }elseif ($MsgId == 1069){
            //SellItemReq 出售道具
            $data_SellItemReq = SellItemReq::decode($Data);
            //计算道具所需价格
        }
    }
    function index()
    {
        $this->response()->write("123");

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
     *
     */
    public function tt()
    {
        $data = $this->data;
    }

    /**
     * 登录websocket服务器
     * 消息id 1004
     */
    public function msgid_1004()
    {
        var_dump('msgid_1004');
        $Data = $this->request()->getArg('data');
        $token = \App\Protobuf\Req\ConnectingReq::decode($Data);
        //redis查询token是否存在
        $Account = new Account();
        $uid = $Account->getToken($token);
        var_dump($uid);
        if($uid){
            $dataCenter = new \App\Models\DataCenter\DataCenter();
            $dataCenter->saveClient($this->client()->getFd(),$uid);
            //登录成功
            $data = \App\Protobuf\Result\ConnectingResult::encode($uid);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1057,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
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
        $Data = $this->request()->getArg('data');
        $create_req_data = \App\Protobuf\Req\CreateRoleReq::decode($Data);

        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());

        $data = ['uid'=>$uid,'nickname'=>$create_req_data['Name'],'sex'=>$create_req_data['Sex'],'status'=>1,'create_time'=>time()];
        $Role = new Role();
        $rs = $Role->createRole($data);//创建角色
        if($rs){
            //角色创建成功
            $data = \App\Protobuf\Result\CreateRoleResult::encode($create_req_data);
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

        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());
        $data = JoinGameResult::encode(['uid'=>$uid]);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1066,$data);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 刷新商城商品
     * 消息id 1077
     */
    public function msgid_1077()
    {
        $Data = $this->request()->getArg('data');
        $shopType = RefDropShopReq::decode($Data);
        $str = RefDropShopResult::encode($shopType);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 掉落库商品购买
     * 消息id 1075
     */
    public function msgid_1075()
    {
        $Data = $this->request()->getArg('data');
        $data_DropShopPingReq = DropShopPingReq::encode($Data);
        $ShopTypeId = $data_DropShopPingReq['ShopTypeId'];
        $ItemId = $data_DropShopPingReq['ItemId'];
        $DropKuId = $data_DropShopPingReq['DropKuId'];
        $GridId = $data_DropShopPingReq['GridId'];
        $RoleBag = new RoleBag();

        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());
        $RoleBag->updateRoleBag($uid,['id'=>$ItemId,'CurCount'=>99]);

        $data = DropShopPingResult::encode($data_DropShopPingReq);

        $str = \App\Protobuf\Result\MsgBaseSend::encode(1107,$data);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        $data = AddItemResult::encode($uid);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1053,$data);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);

        //返回结果
    }

    /**
     * 请求加载商店
     * 消息id 1106
     */
    public function msgid_1106()
    {
        //请求加载商店
        $data = \App\Protobuf\Result\ShopAllResult::encode();
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1145,$data);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * SellItemReq 出售道具
     * 消息id 1069
     */
    public function msgid_1014()
    {
        $Data = $this->request()->getArg('data');
        $data_SellItemReq = SellItemReq::decode($Data);
        var_dump($data_SellItemReq);
        //计算道具所需价格
        $Item = new Item();
        $PriceType  = $Item->getSellItemInfo($data_SellItemReq);
        //出售道具事件
        if($PriceType){
            //出售成功
            $RoleBag = new RoleBag();
            $dataCenter = new \App\Models\DataCenter\DataCenter();
            $uid = $dataCenter->getUidByFd($this->client()->getFd());
            foreach ($PriceType as $k => $v) {
                $update_bag1 = ['id'=>$k,'CurCount'=>$v];//金币增加
                $update_bag2 = ['id'=>$data_SellItemReq['ItemId'],'CurCount'=>(-1)*$data_SellItemReq['Count']];//道具数量减少
                $RoleBag->updateRoleBag($uid,$update_bag1);
                $RoleBag->updateRoleBag($uid,$update_bag2);
            }
            $data = SellItemResult::encode($uid);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1069,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            //调用事件
            $dispatcher = new EventDispatcher();
            $subscriber = new ChangeItemSubscriber();
            $dispatcher->addSubscriber($subscriber);
            $ids = [$data_SellItemReq['ItemId']];
            $dispatcher->dispatch('SellItem',new SellItemEvent($uid,$ids));
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
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1193,$data);
        ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 改变时装请求
     * 消息id 1002
     */
    public function msgid_1002()
    {
        $Data = $this->request()->getArg('data');
        //1 解析属性id
        $ids = ChangeAvatarReq::decode($Data);
        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());
        //2修改用户属性
        $UserAttr = new UserAttr();
        $UserAttr->setUserAttr($uid,$ids);
        //调用事件
        $dispatcher = new EventDispatcher();
        $subscriber = new ChangeAvatarSubscriber();
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch('changeAvatar',new ChangeAvatarEvent($uid,$ids));
    }

    /**
     * 购买时装
     * 消息id 1150
     */
    public function msgid_1150()
    {
        $Data = $this->request()->getArg('data');
        $item_ids = \App\Protobuf\Req\ModelClothesReq::decode($Data);
        //购买时装操作 计算金额 放入背包

        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());

        $shop = new Shop();
        $bool = $shop->Buy($uid,$item_ids);
        $RoleBag = new RoleBag();
        if($bool){
            //加入背包
            foreach ($item_ids as $id) {
                $RoleBag->updateRoleBag($uid,['id'=>$id,'CurCount'=>1]);
            }
            var_dump($item_ids);

            $data = ModelClothesResult::encode($item_ids);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1203,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        }else{
            //余额不足
            $res = Db::table('GameEnum')->where(['msg'=>'没有足够的金钱'])->find();
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1203,0,$res['value'],$res['msg']);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
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
        $Data = $this->request()->getArg('data');
        $data_RoleInfoIcon = \App\Protobuf\Req\UpdateRoleInfoIconReq::decode($Data);
        $dataCenter = new \App\Models\DataCenter\DataCenter();
        $uid = $dataCenter->getUidByFd($this->client()->getFd());
        //修改个人头像
        $role = new Role();
        $rs = $role->updateIcon($uid,$data_RoleInfoIcon['RoleIcon']);
        if($rs){
            //修改成功
            $data = UpdateRoleInfoIconResult::encode($data_RoleInfoIcon['RoleIcon']);
            $str = \App\Protobuf\Result\MsgBaseSend::encode(1141,$data);
            ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
        }else{

        }
    }
}