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
use App\Event\ItemEvent;
use App\Event\ItemSubscriber;
use App\Models\DataCenter\DataCenter;
use App\Models\Test\Event;
use App\Models\Execl\GameEnum;
use App\Models\Trade\Shop;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Protobuf\LoadData\ShopAll;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadRoleBagInfo;
use App\Protobuf\Result\ShopAllResult;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use think\Db;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Index extends Controller
{
    private $key;
    private $msg;
    public function tt()
    {
//        $dataCenter = new DataCenter();
//        $dataCenter->saveClient(1,12);
////        $a = $dataCenter->getUidByFd(12);
//        $a = $dataCenter->delClient(1);
////        var_dump($a);
//        $this->writeJson(200,$a,'1');
    }
    public function index()
    {

        //$shop = new Shop();
        //$shop->Buy(2,[1011,1021]);
        $dispatcher = new EventDispatcher();
        $subscriber = new ItemSubscriber();
        //$event = new Event();
//        $event->t("chinese.name");
        $dispatcher->addSubscriber($subscriber);
//        $dispatcher->dispatch("english.name", new BookEvent());
        $dispatcher->dispatch("update",new ItemEvent(1,[1011=>0]));

//        $dispatcher->removeSubscriber($subscriber);
//        $dispatcher->dispatch("math.name");

        $Role = new Role();
        $arr = $Role->getRole(2);
        $this->response()->write(json_encode($arr));
    }

    public function setRolebag()
    {
        //获取背包信息
        $RoleBag = new RoleBag();
        $RoleBag->updateRoleBag(2,['id'=>1]);
    }

    public function LoadRoleBagInfo()
    {
        $arr = LoadBagInfo::encode(2);
        var_dump($arr);
    }
    //道具表
    public function ExeclItem()
    {
        $file_temp = 'Execl/Item.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
//        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//        var_dump($sheetData);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
//        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
//        var_dump($highestColumn);

        $num = 0;
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k !=$highestColumn; $k++) {

                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type","text/html;charset=utf-8");
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if($key){
                    $arr[$key] = trim($str,"\\");
                }

            }
            $this->response()->write(json_encode($arr));
//            var_dump($arr);
            Db::table('item')->insert($arr);
        }
    }

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
                    $arr1[$this->key]['msg'] = $this->msg;
                }

            }

//            $arr1[$this->key]['msg']= $this->msg;
//                $this->response()->write(json_encode($arr1));
        }
        var_dump($arr1);
        $GameEnum = new GameEnum();
        $GameEnum->insert($arr1);
    }

}