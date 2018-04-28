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
use App\Protobuf\Result\ShopAllResult;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Test extends Controller
{
    public function index()
    {
//        $test = new ShopConfig(1);
//        $test->handle();
//        $test = new DropStore(2);
//        $a = json_encode($test->refreshDropShop());
////        var_dump($test->addBag(2,2000));
//        $a = json_encode($test->refreshDropShop());
        $bag = new Bag(1);
        $a = $bag->test(1,2);
//        $bag->initBag();
//        $a = ShopAllResult::encode(1);
        $this->response()->write(json_encode($a));
    }
}