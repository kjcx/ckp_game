<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;
use App\Models\DataCenter\DataCenter;
use App\Models\Execl\GameEnum;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Protobuf\LoadData\ShopAll;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadRoleBagInfo;
use App\Protobuf\Result\ShopAllResult;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use think\Db;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Index extends Controller
{

    public function tt()
    {
        $dataCenter = new DataCenter();
        $dataCenter->saveClient(1,12);
//        $a = $dataCenter->getUidByFd(12);
        $a = $dataCenter->delClient(1);
//        var_dump($a);
        $this->writeJson(200,$a,'1');
    }
    public function index()
    {

        $date = new \DateTime();
        echo $date->format('U = Y-m-d H:i:s') . "\n";

        $date->setTimestamp($date->getTimestamp() + 86400*365*100);
        echo $date->format('U = Y-m-d H:i:s') . "\n";

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

        $file_temp = 'Execl/_GameEnum.xlsx';
        $spreadsheet = IOFactory::load($file_temp);
        $sheet = $spreadsheet->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);
        $num = 0;
        for($j=1;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k != 'E'; $k++) {
                $str = $spreadsheet->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type", "text/html;charset=utf-8");
                $key = $spreadsheet->getActiveSheet()->getCell("{$k}1")->getValue();
                if ($key =='描述') {
                    $key = 'msg';
                    $arr[$key] = trim($str, "\\");
                }elseif ($key =='类型') {
                    $key = 'type';
                    $arr[$key] = trim($str, "\\");
                }elseif ($key =='值') {
                    $key = 'value';
                    $arr[$key] = trim($str, "\\");
                }
            }
            $this->response()->write(json_encode($arr));
            $GameEnum = new GameEnum();
            $GameEnum->insert($arr);

        }
    }

}