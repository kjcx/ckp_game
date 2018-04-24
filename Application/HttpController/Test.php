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
use App\Models\Store\DropStore;
use App\Models\Store\ShopConfig;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Test extends Controller
{
    public function index()
    {
////        $test = new ShopConfig(1);
//        $test = new DropStore(1);
////        var_dump($test->addBag(2,2000));
//        $a = json_encode($test->refreshDropShop());
        $bag = new Bag(2);
        $bag->initBag();
        $this->response()->write(1);
    }
}