<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;

use App\Event\ChangeItemEvent;
use App\Event\ChangeItemSubscriber;
use App\Event\ItemEvent;
use App\Models\BagInfo\Bag;
use App\Models\Company\Shop;
use App\Models\Item\ItemBak;
use App\Models\User\RoleBag;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadStaffResult;
use AutoMsg\LoadRefStaff;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Config;
use think\Db;

class Gold extends Controller
{
    public function index2()
    {
        $uid = $this->request()->getQueryParam('uid');
        $num = $this->request()->getQueryParam('num');

        $Bag = new Bag($uid);
        $Bag->addBag(2,$num);
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write('充值成功');
    }
    public function index6()
    {
        $uid = $this->request()->getQueryParam('uid');
        $num = $this->request()->getQueryParam('num');
        $Bag = new Bag($uid);
        $Bag->addBag(6,$num);
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write('充值成功');
    }

    function index()
    {
        // TODO: Implement index() method.
    }
}