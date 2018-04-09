<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午1:56
 */
namespace  App\Websocket\Controller;

use App\Models\DataCenter;

use App\Models\User\Account;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Protobuf\Req\DropShopPingReq;
use App\Protobuf\Req\RefDropShopReq;
use App\Protobuf\Req\SellItemReq;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\DropShopPingResult;
use App\Protobuf\Result\JoinGameResult;
use App\Protobuf\Result\RefDropShopResult;
use AutoMsg\ConnectingReq;
use AutoMsg\ConnectingResult;
use AutoMsg\CreateRoleReq;
use AutoMsg\CreateRoleResult;
use AutoMsg\MsgBaseRev;
use AutoMsg\MsgBaseSend;
use AutoMsg\RoleLists;
use AutoMsg\ShopAllResult;
use EasySwoole\Config;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\ServerManager;

class Web extends WebSocketController
{
    function actionNotFound(?string $actionName)
    {

        parent::actionNotFound($actionName); // TODO: Change the autogenerated stub
        $arr = \App\Protobuf\Result\MsgBaseRev::decode($this->client()->getData());

        $MsgId = $arr['MsgId'];
        var_dump($MsgId);
        $Data = $arr['Data'];
        if($MsgId == 1004){
            $token = \App\Protobuf\Req\ConnectingReq::decode($Data);
            var_dump($token);
            //redis查询token是否存在
            $Account = new Account();
            $uid = $Account->getToken($token);
            if($uid){
                $dataCenter = new DataCenter();
                $dataCenter->saveClient($this->client()->getFd(),$uid);
                //登录成功
                $data = \App\Protobuf\Result\ConnectingResult::encode($uid);
                var_dump($data);
                $str = \App\Protobuf\Result\MsgBaseSend::encode(1057,$data);
                ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$str,WEBSOCKET_OPCODE_BINARY);
            }
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
            $RoleBag->updateRoleBag(2,['id'=>$ItemId,'Count'=>99]);

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

}