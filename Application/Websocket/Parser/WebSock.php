<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/3/6
 * Time: 下午2:53
 */

namespace App\Websocket\Parser;


use App\Websocket\Controller\web;
use EasySwoole\Core\Socket\AbstractInterface\ParserInterface;
use EasySwoole\Core\Socket\Common\CommandBean;

class WebSock implements ParserInterface
{

    /**
     * @param $raw
     * @param $client
     * @return CommandBean
     */
    public function decode($raw, $client)
    {
        // TODO: Implement decode() method.
        $command = new CommandBean();
        $json = json_decode($raw,1);
        $command->setControllerClass(Web::class);
        $command->setAction($json['action']);
        $command->setArg('content',$json['content']);
        return $command;
    }

    public function encode(string $raw, $client, $commandBean): ?string
    {
        // TODO: Implement encode() method.
        if($raw ==''){
            return null;
        }
        return $raw;
    }
}