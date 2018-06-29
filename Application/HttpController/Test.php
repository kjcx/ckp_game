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
use App\Models\BagInfo\BagNew;
use App\Models\Excel\WsResult;
use App\Models\Item\ItemBak;
use App\Models\Manor\Land;
use App\Models\Room\Room;
use App\Models\Store\DropStore;
use App\Models\Store\Seed;
use App\Models\Store\ShopConfig;
use App\Protobuf\Result\ShopAllResult;
use App\Utility\Cache;
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

    public function index()
    {
        $bagNew = new BagNew(87);
        var_dump($bagNew->initBag());
    }
}