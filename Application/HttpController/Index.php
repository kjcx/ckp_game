<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;

use App\Event\BookEvent;
use App\Event\BookSubscriber;
use App\Event\ChangeAvatarEvent;
use App\Event\ChangeAvatarSubscriber;
use App\Event\ItemEvent;
use App\Event\ItemResultEvent;
use App\Event\ChangeItemSubscriber;
use App\Event\UserEvent;
use App\Models\BagInfo\Bag;
use App\Models\DataCenter\DataCenter;
use App\Models\Execl\Character;
use App\Models\Execl\Mission;
use App\Models\Execl\Topup;
use App\Models\Execl\WsResult;
use App\Models\Test\Event;
use App\Models\Execl\GameEnum;
use App\Models\Trade\Shop;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Protobuf\LoadData\ShopAll;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadRoleBagInfo;
use App\Protobuf\Result\MsgBaseRev;
use App\Protobuf\Result\SellItemResult;
use App\Protobuf\Result\ShopAllResult;
use App\Protobuf\Result\UpdateItemResult;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Db;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Index extends Controller
{
    private $key;
    private $msg;

    public function index()
    {

        $bag = new Bag(2);
        $bag->initBag();
    }

    public function setRolebag()
    {
        //获取背包信息
        //设置个人掉落库信息
        ['uid'=>2,'shoplost'=>[
            ['itemid'=>1011,'Count'=>3],
            ]
        ];
        $RoleBag = new RoleBag();
        $RoleBag->updateRoleBag(2,['id'=>1]);
    }

    public function LoadRoleBagInfo()
    {
        $arr = LoadBagInfo::encode(2);
        var_dump($arr);
    }





}