<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:39
 * 赵
 */
namespace App\HttpController;

use App\Models\User\Role;
use EasySwoole\Config;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use GuzzleHttp\Client;
class User extends SmartViewController
{

    function index()
    {
        // TODO: Implement index() method.
        // Smarty
        $method = $this->request()->getMethod();

        $Account = new \App\Models\User\Account();

//        var_dump($token);
        if($method == 'POST'){
            $token = $Account->get_app_token();
            //生成新的账户
            $token = $token+1;
            $Account->insert(['app_token'=>$token,'user_name'=>'kjcx'.$token,'create_time'=>time(),'update_time'=>time()]);
        }
        $data = $Account->getAll();

        $this->assign('data',$data);
        $this->fetch('index.html'); # 对应模板: Views/index.html
    }
}
