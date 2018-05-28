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
        $aa = new Shop();
        $data = $aa->getAllShop(37);
        var_dump($data);
        return;
        $client = new Client();
        for ($i=0;$i<5;$i++){
//            $data_ip = $this->index2();
//            foreach ($data_ip as $item) {
//                $ip = trim($item);
                $new_str = $this->rand_str();
                $url = 'http://redbull.hxrdcode.com/template/verify/verify.html?codeString='. $new_str . '&flag=1';
//                $content = $client->request('get', $url,['proxy'=>[
//                    'http'=>'http://127.0.0.1',
//////                    'https'=>'http://221.229.166.87:10128',
//                ]] );
                $content = $client->request('get', $url);
                usleep(1000);
                $res_str = $content->getBody()->getContents();
//                var_dump($res_str);
                $len = stripos($res_str,'<span class="dc">');
                $code = substr($res_str,$len +17,12);
                if($code!='错误数据'){
                    file_put_contents('log.txt',$new_str."\r\n",FILE_APPEND);
                }else{
                    file_put_contents('log1.txt',$code.'=>'.$new_str."\r\n",FILE_APPEND);
                }
//            }

        }

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