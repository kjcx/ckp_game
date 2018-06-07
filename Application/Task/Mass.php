<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * time: 下午5:33
 * 投递任务模板
 */

namespace App\Task;

use EasySwoole\Core\Swoole\ServerManager;
use EasySwoole\Core\Swoole\Task\AbstractAsyncTask;

class Mass extends AbstractAsyncTask
{
    /**
     * 执行任务的内容
     * @param mixed $taskData     任务数据 数组形式  ['data','fd','message'] 数据 fd 消息体
     * @param int   $taskId       执行任务的task编号
     * @param int   $fromWorkerId 派发任务的worker进程号
     */
    public function run($taskData, $taskId, $fromWorkerId)
    {
        //处理buffer 内容
        var_dump($taskData);
        ServerManager::getInstance()->getServer()->push($taskData['fd'],$taskData['data'],WEBSOCKET_OPCODE_BINARY);

        return '投送成功!';
    }

    /**
     * 任务执行完的回调
     * @param mixed $result  任务执行完成返回的结果
     * @param int   $task_id 执行任务的task编号
     */
    public function finish($result, $task_id)
    {
        echo $result;
    }
}
