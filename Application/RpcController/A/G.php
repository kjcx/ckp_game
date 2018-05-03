<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/28
 * Time: 下午2:36
 */

namespace App\RpcController\A;


use EasySwoole\Core\Component\Rpc\AbstractInterface\AbstractRpcService;

class G extends AbstractRpcService
{
    function index()
    {
        // TODO: Implement index() method.
        $this->response()->setArgs([12,3]);
    }
}

