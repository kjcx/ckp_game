<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/28
 * Time: 下午2:37
 */

namespace App\RpcController\B;


use EasySwoole\Core\Component\Rpc\AbstractInterface\AbstractRpcService;

class Index extends AbstractRpcService
{

    function index()
    {
        // TODO: Implement index() method.
        $this->response()->setResult('this is b index');
    }
}