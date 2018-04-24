<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;

use App\Event\ItemEvent;
use App\Models\Item\Item;
use App\Models\User\RoleBag;
use App\Protobuf\Result\LoadBagInfo;
use EasySwoole\Core\Http\AbstractInterface\Controller;
class Index extends Controller
{
    private $key;
    private $msg;

    /**
     *
     */
    public function index()
    {

        $a  = new Item();
        $arr = $a->getItemIds([6,7,8]);
        var_dump($arr);
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