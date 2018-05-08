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

class Execl extends Controller
{
    /**
     * 掉落库
     */
    public function ExeclDrop()
    {
        $file_temp = 'Execl/Drop.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);
        $num = 0;
        for($j=3;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k !='E'; $k++) {

                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type","text/html;charset=utf-8");
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if($key){
                    $arr[$key] = trim($str,"\\");
                }

            }
            $this->response()->write(json_encode($arr));
//            var_dump($arr);
            Db::table('Drop')->insert($arr);
        }
    }

    public function Execl_GameEnum()
    {

        $file_temp = 'Execl/_GameEnum1.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);
        $num = 0;
        for($j=2;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'E'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type", "text/html;charset=utf-8");
                $key1 = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                $key  = $spreadsheet->getActiveSheet()->getCell("B$j")->getValue() . '\\';//读取单元格] = $str;
                $msg  = $spreadsheet->getActiveSheet()->getCell("A$j")->getValue() . '\\';//读取单元格] = $str;
                $str =   trim($str, "\\");
                $key =   trim($key, "\\");
                $msg =   trim($msg, "\\");
                if($k == 'C'){
                    if($str == ''){
                        $this->key = $key;
                        $this->msg = $msg;
                    }
                }
                if ($key1 =='描述') {
                    $key1 = 'msg';
                    $arr[$key1] = $str;
                }elseif ($key1 =='类型') {
                    $key1 = 'type';
                    $arr[$key1] = $str;
                }elseif ($key1 =='值') {
                    $key1 = 'value';
                    $arr[$key1] = $str;
                    if($str ==''){
                        unset($arr);
                    }

                }

            }
            if($this->key){
                if(count($arr)>0){
                    $arr1[$this->key]['list'][] = $arr;
                    $arr1[$this->key]['title'] = $this->msg;
                }

            }

//            $arr1[$this->key]['msg']= $this->msg;
//                $this->response()->write(json_encode($arr1));
        }
        $GameEnum = new GameEnum();
        foreach ($arr1 as $k=>$item) {
            $GameEnum->insert(['title'=>$item['title'],'type'=>$k,'list'=>$item['list']]);
        }

    }
//返回码
    public function WsResult()
    {
        $GameEnum = new GameEnum();
        $WsResult = new WsResult();
        $data = $GameEnum->find(['type'=>'WsResult']);
        foreach ($data['list'] as $datum) {
            $WsResult->insert($datum);
        }
    }
    //角色默认信息
    public function Execl_Character()
    {
        $file_temp = 'Execl/Character.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);
        $num = 0;
        $Character = new Character();
        for($j=3;$j<=15;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'K'; $k++) {

                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if($key){
                    $arr[$key] = trim($str,"\\");
                }

            }
            $this->response()->write(json_encode($arr));
            var_dump($arr);
            $Character->insert($arr);

        }
    }

    public function Execl_Topup()
    {
        $file_temp = 'Execl/Topup.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);
        $num = 0;
        $Topup = new Topup();
        for($j=3;$j<=15;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'E'; $k++) {

                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if($key){
                    if($key == 'Id'){
                        $arr[$key] = (int)trim($str,"\\");
                    }else{
                        $arr[$key] = trim($str,"\\");
                    }

                }

            }
            $this->response()->write(json_encode($arr));
            var_dump($arr);
            $Topup->insert($arr);

        }
    }

    function index()
    {
        // TODO: Implement index() method.
    }

    public function Execl_Mission()
    {
        $file_temp = 'Execl/Building.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestRow);
        die;
        $num = 0;
        $Mission = new Mission();
        for($j=3;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'L'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if($key){
                    if($key == 'Id'){
                        $arr[$key] = (int)trim($str,"\\");
                    }else{
                        $arr[$key] = trim($str,"\\");
                    }

                }

            }
            $this->response()->write(json_encode($arr));
//            $Mission->insert($arr);

        }
    }
}