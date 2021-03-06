<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/3/6
 * Time: 下午2:53
 */

namespace App\Websocket\Parser;


use App\Websocket\Controller\Web;
use AutoMsg\MsgBaseRev;
use EasySwoole\Core\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Core\Socket\Common\CommandBean;

class WebSockFinsh implements ParserInterface
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
        $msgId = $baseMessage->getMsgId();
        $data = $baseMessage->getData();
        $command->setControllerClass(Web::class);

        $command->setAction('msgid_' . $msgId);
        $command->setArg('data',$data);
        return $command;
    }

    public static function encode(string $raw, $client, $commandBean): ?string
    {
        // TODO: Implement encode() method.
        if (empty($raw)) {

            return null;
        }
        return $raw;
    }
}