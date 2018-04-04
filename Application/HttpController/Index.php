<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
class Index extends Controller
{
    function index(){
        $Account = new \App\Models\User\Account();
        var_dump($Account->getToken("fcf7c140ec5a39021efcad185853e21a"));
        $this->response()->write(rand(10000,99999));
    }
}