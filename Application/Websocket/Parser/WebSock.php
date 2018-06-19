<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/3/6
 * Time: 下午2:53
 */

namespace App\Websocket\Parser;


use App\Websocket\Controller\Web;
use AutoMsg\ConnectingReq;
use AutoMsg\MsgBaseRev;
use EasySwoole\Core\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Core\Socket\Common\CommandBean;

class WebSock implements ParserInterface
{

    /**
     * @param $raw
     * @param $client
     * @return CommandBean
     */
    public static function decode($raw, $client)
    {

        // TODO: Implement decode() method.
        $command = new CommandBean();
        $baseMessage = new MsgBaseRev();
        $baseMessage->mergeFromString($raw);

        $data = $baseMessage->getData();
        $msgId = $baseMessage->getMsgId();
        $command->setControllerClass(Web::class);
        var_dump("msgid_".$msgId);
        var_dump(111222333);
        var_dump($data);
        $command->setAction('msgid_' . $msgId);
//        $command->setAction('msgid_1004');

        $command->setArg('data',$data);

        return $command;
    }

    public static function encode(string $raw,$client):?string
    {
        // TODO: Implement encode() method.
        if (empty($raw)) {

            return null;
        }
        return $raw;
    }
}


