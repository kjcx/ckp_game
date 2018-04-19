<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/19
 * Time: 上午11:45
 * 测试控制器
 */

namespace App\HttpController;

use EasySwoole\Core\Http\AbstractInterface\Controller;

class Test extends Controller
{
    public function index()
    {
        $this->response()->write('1');
    }
}