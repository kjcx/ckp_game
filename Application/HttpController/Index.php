<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;
use EasySwoole\Core\Http\AbstractInterface\Controller;
class Index extends Controller
{
    function index(){
        var_dump(1);
        new \App\Model\User\Account();
        $this->response()->write(1113);
    }
}