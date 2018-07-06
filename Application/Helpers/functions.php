<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/11
 * Time: 下午2:59
 */
/**
 * 事件调用方法
 */
if (!function_exists('event')) {
    function event($event,$eventData = false)
    {
        $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
        $event = $eventData ? (new $event($eventData)) : (new $event);
        $dispatcher->addSubscriber($event->getListen());
        $dispatcher->dispatch($event::NAME,$event);
    }
}
/**
 * 推送方法 （异步）
 */
if (!function_exists('push')) {
    function push($MsgId,$uid,$data,$errorMsg = '')
    {
        \EasySwoole\Core\Swoole\Task\TaskManager::async(function () use ($MsgId,$uid,$data,$errorMsg){
            $dataCenter = new \App\Models\DataCenter\DataCenter();
            $fd = $dataCenter->getFdByUid($uid);
            if ($errorMsg) {
                $WsResult = new \App\Models\Excel\WsResult();
                $data_ws = $WsResult->getErrorValue($errorMsg);
                $value = $data_ws['value'];
            } else {
                $value = 0;
            }
            $str  = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data,$value);
            \EasySwoole\Core\Swoole\ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
        });
    }
}
/**
 * 更新排行榜
 */
if (!function_exists('updateRank')) {
    function updateRank($uid,$score,$type)
    {
        $rank = new \App\Models\Rank\RankList();
        return $rank->setRankToQueue($uid,$type,$score);
    }
}