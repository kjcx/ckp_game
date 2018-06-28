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
use App\Models\DataCenter\DataCenter;
use App\Models\Excel\BuildingLevel;
use App\Models\Excel\GameConfig;
use App\Models\Excel\Item;
use App\Models\Excel\LandInfo;
use App\Models\FriendInfo\FriendInfo;
use App\Models\FruitsData\FruitsData;
use App\Models\LandInfo\MyLandInfo;
use App\Models\Npc\NpcInfo;
use App\Models\Npc\NpcTask;
use App\Models\Sales\SalesItem;
use App\Models\Mail\MailMsg;
use App\Models\Sign\SignInfo;
use App\Models\Staff\Staff;
use App\Models\Store\DropStaff;
use App\Models\User\RoleBag;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadStaffResult;
use App\Task\Mass;
use AutoMsg\LoadRefStaff;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Config;
use think\Db;

class Index extends Controller
{
    private $key;
    private $msg;

    /**
     *
     */
    public function index()
    {
        $NpcInfo = new NpcInfo();
        $DATA = $NpcInfo->getRedisNpcList(65);
        var_dump($DATA);
    }
    public function rand_str()
    {

        $NpcTask = new NpcTask();
        $data = $NpcTask->getRedisTask(65);
        var_dump($data);
    }
    public function index2()
    {

       $Mail = new MailMsg();
       $list = $Mail->getRedisMailByUid(40);
        var_dump($list);
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
    }
    public function   test()
    {
        $SignInfo = new SignInfo();

        $SignInfo->setSign(40);

        $arr = $SignInfo->getSign(40);

    }





}