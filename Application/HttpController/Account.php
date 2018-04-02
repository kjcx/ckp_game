<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:39
 */
namespace App\HttpController;

use EasySwoole\Core\Http\AbstractInterface\Controller;

class Account extends Controller
{
    /**
     * CKLogin 游戏登录接口
     */
    public function CKLogin(){
        $this->response()->write('CKLogin124');
    }

    function index()
    {
        // TODO: Implement index() method.
    }
}