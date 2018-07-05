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
use App\Models\Excel\Building;
use App\Models\Excel\BuildingLevel;
use App\Models\Excel\Character;
use App\Models\Excel\Drop;
use App\Models\Excel\Fruits;
use App\Models\Excel\GameConfig;
use App\Models\Excel\Lotto;
use App\Models\Excel\Mission;
use App\Models\Excel\Randomname;
use App\Models\Excel\Staff;
use App\Models\Excel\Topup;
use App\Models\Excel\Train;
use App\Models\Excel\WsResult;
use App\Models\Test\Event;
use App\Models\Excel\GameEnum;
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
    public $key;
    public $msg;
    /**
     * 掉落库
     */
    public function ExeclDrop()
    {
        $file_temp = 'Excel/Drop.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Execl_Drop = new Drop();
        for($j=4;$j<=$highestRow;$j++) {
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
            $Execl_Drop->insert($arr);
        }
    }

    public function Execl_GameEnum()
    {

        $file_temp = 'Excel/_GameEnum.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
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
        $file_temp = 'Excel/Character.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
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
            $Character->insert($arr);

        }
    }

    public function Execl_Topup()
    {
        $file_temp = 'Excel/Topup.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
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
            $Topup->insert($arr);

        }
    }

    function index()
    {
        // TODO: Implement index() method.
    }

    public function Execl_Mission()
    {
        $file_temp = 'Excel/Building.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
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

    /**
    * 店铺表
     */
    public function Execl_Building()
    {
        $file_temp = 'Excel/Building.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Building = new Building();
        for($j=4;$j<=8;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'J'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $Building->insert($arr);
            $this->response()->write(json_encode($arr));
        }
    }

    /**
     * 等级对照表
     */
    public function Execl_BuildingLevel()
    {
        $file_temp = 'Excel/BuildingLevel.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $BuildingLevel = new BuildingLevel();
        for($j=4;$j<=103;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'K'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $BuildingLevel->insert($arr);
            $this->response()->write(json_encode($arr));
        }
    }

    /**
     * 等级对照表
     */
    public function Execl_Lotto()
    {
        $file_temp = 'Excel/Lotto.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Lotto = new Lotto();
        for($j=4;$j<=6;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'K'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $Lotto->insert($arr);
            $this->response()->write(json_encode($arr));
        }
    }

    /**
     * 配置
     */
    public function Execl_GameConfig()
    {
        $file_temp = 'Excel/_GameConfig.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $GameConfig = new GameConfig();
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'K'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $GameConfig->insert($arr);
            $this->response()->write(json_encode($arr));
        }
    }
    /**
     * 配置
     */
    public function Execl_Staff()
    {
        $file_temp = 'Excel/Staff.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Staff = new Staff();
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'I'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $Staff->insert($arr);
            $this->response()->write(json_encode($arr));
        }
    }

    /**
     * 姓名
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function Execl_Train()
    {
        $file_temp = 'Excel/Train.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);

        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Train = new Train();
        for($j=4;$j<$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'D'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key) {
                    if ($key == 'Id') {
                        $arr[$key] = (int)trim($str, "\\");
                    } elseif($key == 'Type'){
                        $arr[$key] = (int)trim($str, "\\");
                    }
                    else {
                        $arr[$key] = trim($str, "\\");
                    }
                }
            }
            $Train->insert($arr);

            $this->response()->write(json_encode($arr));

        }
    }

    /**
     * 道具
     */
    public function Execl_Item()
    {
        $file_temp = 'Excel/Item.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Item = new \App\Models\Excel\Item();
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k !='AE'; $k++) {

                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type","text/html;charset=utf-8");
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key == 'Id') {
                    $arr[$key] = (int)trim($str, "\\");
                } elseif($key == 'Type'){
                    $arr[$key] = (int)trim($str, "\\");
                }
                else {
                    $arr[$key] = trim($str, "\\");
                }

            }
            $this->response()->write(json_encode($arr));
//            var_dump($arr);
            $Item->insert($arr);
        }
    }

    /**
     * 水果机
     */
    public function Execl_Fruits()
    {
        $file_temp = 'Excel/Fruits.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $num = 0;
        $Fruits = new Fruits();
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k !='E'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type","text/html;charset=utf-8");
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key == 'Id') {
                    $arr[$key] = (int)trim($str, "\\");
                } elseif($key == 'Type'){
                    $arr[$key] = (int)trim($str, "\\");
                }
                else {
                    $arr[$key] = trim($str, "\\");
                }

            }
            $this->response()->write(json_encode($arr));
//            var_dump($arr);
            $Fruits->insert($arr);
        }
    }
}