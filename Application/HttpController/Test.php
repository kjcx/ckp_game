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
//        $bagNew = new BagNew(87);
//        var_dump($bagNew->initBag());
        //$room = new Room('34');
       // $data = $room->getUseRoom();
       // var_dump($data);


        //ok:查询到当前级别的金额
        //定义充值级别Id：1-6
        $Id=3;
        $Topup = new \App\Models\Excel\Topup();
        //查询当前级别信息
        $data_Topup = $Topup->findById($Id);


        // var_dump($data_Topup);


        //无返回信息：
        //Account.php-payByApp()-  $res = $client->request('POST',$url,['form_params'=>$postdata]);
        //$client = new Client();-Config.php:URL出错
        //改为：$APP_SERVER_URL = 'http://chuangke.jygeili.com:81/';
        //充值的用户密码
        $Pwd='123456';
        //测试读取账户充值信息是否充值成功
        $Account = new \App\Models\User\Account();
         $res = $Account->payByApp(37,'100','123456','game_recharge');
        //var_dump($data_Topup['Gold']);
        //$res = $Account->payByApp(37,$data_Topup['Gold'],$Pwd,'game_recharge');
        echo ("111111111111111111111111111111111111111");
        var_dump($res);

        //ok
         //$bag=new \App\Models\BagInfo\Bag(65);
       //  $a=$bag->addBag(1);
        // var_dump($a);

        //测试为NULL
        //充值的用户id
         $Id=38;
         $pay=new \App\Models\Log\Pay();
         $cre=$pay->create([$Id,10,'CreateTime'=>time()]);

        //var_dump($cre);

        //OK
        //获取充值Id是否首冲
         //  $asd=$pay->getFirstRecharge(38);
         //var_dump($asd);

         //*/


    }
}