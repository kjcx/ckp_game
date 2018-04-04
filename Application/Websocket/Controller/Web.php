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
use AutoMsg\ConnectingReq;
use AutoMsg\ConnectingResult;
use AutoMsg\MsgBaseRev;
use AutoMsg\MsgBaseSend;
use AutoMsg\RoleLists;
use EasySwoole\Config;
use EasySwoole\Core\Socket\AbstractInterface\WebSocketController;
use EasySwoole\Core\Swoole\ServerManager;

class Web extends WebSocketController
{
    function actionNotFound(?string $actionName)
    {

        parent::actionNotFound($actionName); // TODO: Change the autogenerated stub
        $MsgRev = new MsgBaseRev();
        $MsgRev->mergeFromString($this->client()->getData());
        $MsgId = $MsgRev->getMsgId();
        var_dump($MsgId);
        $Data = $MsgRev->getData();
        if($MsgId == 1004){
            $ConnectingReq = new ConnectingReq();
            $ConnectingReq->mergeFromString($Data);
            $token = $ConnectingReq->getToken();
            //redis查询token是否存在
            $Account = new Account();
            $rs = $Account->getToken($token);
            if($rs){
                //登录成功
                $ConnectingResult = new ConnectingResult();
                $role = $ConnectingResult->getRoleLists();
                $RoleLists = new RoleLists();
                $role[] = $RoleLists;
                $ConnectingResult->setRoleLists($role);
                $str  = $ConnectingResult->serializeToString();
                $MsgBaseSend = new MsgBaseSend();
                $MsgBaseSend->setMsgID(1057);
                $MsgBaseSend->setResult(0);
                $MsgBaseSend->setData($str);
//                $MsgBaseSend->serializeToString();
                var_dump($MsgBaseSend->serializeToString());
                ServerManager::getInstance()->getServer()->push($this->client()->getFd(),$MsgBaseSend->serializeToString(),WEBSOCKET_OPCODE_BINARY);
            }
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
        foreach ($fds as $fd) {
            $massTemplate = new Mass(['fd' => $fd,'data' => 11,]);
            TaskManager::async($massTemplate);
        }


//        $this->response()->write();
    }

}