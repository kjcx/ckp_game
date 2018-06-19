<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/19
 * Time: 上午11:45
 * 测试控制器
 */

namespace App\HttpController;

use App\Event\RoleCreateEvent;
use App\Models\BagInfo\Bag;
use App\Models\Execl\WsResult;
use App\Models\Item\ItemBak;
use App\Models\Manor\Land;
use App\Models\Store\DropStore;
use App\Models\Store\Seed;
use App\Models\Store\ShopConfig;
use App\Protobuf\Result\ShopAllResult;
use App\Utility\Redis;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class Test extends Controller
{
    private $table = [
        "s",
        "Y",
        "H",
        "N",
        "R",
        "G",
        "A",
        "v",
        "W",
        "M",
        "E",
        "z",
        "P",
        "U",
        "t",
        "w",
        "Q",
        "K",
        "q",
        "C",
        "B",
        "x",
        "D",
        "y",
        "V",
        "I",
        "J",
        "S",
        "L",
        "T",
        "Z",
        "X",
        "O",
        "r",
        "u",
        "F",
    ];

    public function aab()
    {
        event(RoleCreateEvent::class,36);
//        $a = new ItemBak();
//        $b = $a->getOne('人际交往');
//        $this->response()->write(json_encode($b));
    }
    public function index()
    {
//        $test = new ShopConfig(1);
//        $test->handle();
//        $test = new DropStore(2);
//        $a = json_encode($test->refreshDropShop());
////        var_dump($test->addBag(2,2000));
//        $a = json_encode($test->refreshDropShop());
        $bag = new Bag(1);
        $a = $bag->test(1, 2);
//        $bag->initBag();
//        $a = ShopAllResult::encode(1);
        $this->response()->write(json_encode($a));
    }

    public function aa()
    {
//        $ShopAll = new \App\Models\LoadData\ShopAll();
//        $data = $ShopAll->get();//7种类型商品

        $dropShop = new DropStore('1');
        $data = $dropShop->refreshDropShop();
        $this->response()->write(json_encode($data));

    }

    public function bb()
    {
        $redis = Redis::getInstance()->getConnect();
        $redis->connect('192.168.10.10',6379);
        $redis->set('b','sd',20);
        $this->response()->write('sdsdsss2222sd');

    }
    public function tt()
    {
        $a = $this->from10_to62(1000000000);
        $this->response()->write(json_encode($a));
    }

    /**
     * 十进制数转换成62进制
     *
     * @param integer $num
     * @return string
     */
    function from10_to62($num)
    {
        $to = 62;
        $dict = 'qrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ret = '';
        do {
            $ret = $dict[bcmod($num, $to)] . $ret;
            $num = bcdiv($num, $to);
        } while ($num > 0);
        return $ret;
    }

    public function aaa()
    {

    }
}