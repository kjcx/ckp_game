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
use App\Models\Execl\LandInfo;
use App\Models\Item\Item;
use App\Models\LandInfo\MyLandInfo;
use App\Models\Staff\Staff;
use App\Models\Store\DropStaff;
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

class Index extends Controller
{
    private $key;
    private $msg;

    /**
     *
     */
    public function index()
    {
      $this->response()->write(123);
    }
    public function rand_str()
    {

        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $new_str =  substr(str_shuffle($str1),0,1);
//
        $new_str =  'P'.substr(uniqid(),8,5);
        $new_str .=  substr(uniqid(),8,3);
        for($j=0;$j<5;$j++){
            $new_str .=  $str[rand(0,35)];
        }
        var_dump(strtoupper($new_str));
        return strtoupper($new_str);
    }
    public function index2()
    {

        $arr = file('http://vip.zdaye.com/?api=201704181142528378&fitter=2&px=2');
        return $arr;
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
    public function   test($a,$b)
    {
        $c = $a +$b;
        echo $c;
        return $c;
    }





}