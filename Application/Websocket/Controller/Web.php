<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午1:56
 */
namespace  App\Websocket\Controller;

use App\Models\DataCenter;
use EasySwoole\Core\Socket\WebSocketController;

class Web extends WebSocketController
{
    function actionNotFound(?string $actionName)
    {
        parent::actionNotFound($actionName); // TODO: Change the autogenerated stub

        $m = new DataCenter();
        $m->saveClient();
        $this->response()->write("192.168.10.10");
    }
    function index()
    {
        $this->response()->write("123");

    }

}