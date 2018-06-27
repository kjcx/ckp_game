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
        $this->uid =65;
        $data_Spot = ['Spot'=>5];
        //1判断是否有任务
        $NpcTask = new NpcTask();

        $data_task = $NpcTask->getRedisTask($this->uid);
        var_dump($data_task);
        $Count = $data_task['Count'];
        if($Count>=1){
            //判断剩余任务测试
            if( isset($data_task['NpcTask'][$data_Spot['Spot']]['TaskId']) ){
                //存在任务
                $ItemList = $data_task['NpcTask'][$data_Spot['Spot']]['ItemList'];
                //判断道具是否存在
                $Bag = new Bag($this->uid);
                $bool = false;
                foreach ($ItemList as $k => $item) {
                    $bool  = $Bag->checkCountByItemId($k,$item);
                    if(!$bool){
                        var_dump("道具不满足");
                        $this->send(1135,$this->fd,'','道具数量不足');
                        return;
                    }
                }
                if($bool){
                    //扣除道具
                    foreach ($ItemList as $k => $item) {
                        $rs = $Bag->delBag($k,$item);
                        if(!$rs){
                            var_dump("扣除道具失败");
                            return;
                        }
                    }
                    //增加奖励
                    $TaskId = $data_task['NpcTask'][$data_Spot['Spot']]['TaskId'];
                    $NpcId = $data_task['NpcTask'][$data_Spot['Spot']]['NpcId'];
                    $Entrust = new Entrust();
                    $data_Award = $Entrust->getAwardById($TaskId);
                    foreach ($data_Award as $k => $item) {
                        if($k == 8){
                            //好感度 增加npc的好感度
                            $NpcInfo = new NpcInfo();
                            $rs = $NpcInfo->setRedisCurrentFavorability($this->uid,$NpcId,$item);
                            if($rs){
                                //完成任务委托点
                                $data_newtask['Spot'] = $data_Spot['Spot'];
                                //生成新的任务委托点
                                $data_newtask = $NpcTask->UpdateTask($this->uid,$data_Spot['Spot']);
                                $str = AccomplishResidentDelegateResult::encode(['NpcTask'=>$data_newtask,'Spot'=>$data_Spot['Spot']]);
                                $this->send(1135,$this->fd,$str);
                            }else{
                                var_dump("增加好感度失败");
                            }
                        }else{
                            $Bag->addBag($k,$item);
                        }
                    }
                }
            }else{
                var_dump("不存在任务");
            }
        }else{
            var_dump("本回合任务已经完成");
        }
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