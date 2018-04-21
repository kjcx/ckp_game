<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/19
 * Time: 上午11:45
 * 测试控制器
 */

namespace App\HttpController;

use App\Models\BagInfo\Bag;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Test extends Controller
{
    public function index()
    {
        $test = new Bag(1);
        var_dump($test->addBag(2,2000));
        $this->response()->write('1');
    }
}