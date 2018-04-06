<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;
use App\Models\User\Role;
use App\Models\User\RoleBag;
use App\Protobuf\Result\LoadBagInfo;
use App\Protobuf\Result\LoadRoleBagInfo;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use PHPExcel;
use think\Db;

class Index extends Controller
{
    public function index()
    {
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
    public function execl()
    {
        $file_temp = 'Item.xlsx';
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($file_temp,'utf-8')) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($file_temp,'utf-8')) {
                echo 'no Excel';
            }
        }

        $PHPExcel = $PHPReader->load($file_temp);

        $sheet = $PHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        var_dump($highestRow);
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        var_dump($highestColumn);

        $num = 0;
        for($j=4;$j<=$highestRow;$j++) {
            $str = '';
            for ($k = 'A'; $k !=$highestColumn; $k++) {

                $str = $PHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . '\\';//读取单元格
                $this->response()->withHeader("Content-Type","text/html;charset=utf-8");
                $key = $PHPExcel->getActiveSheet()->getCell("{$k}1")->getValue();
                $arr[$key] = trim($str,"\\");

            }
            $this->response()->write(json_encode($arr));
//            Db::table('item')->insert($arr);
        }
    }
    
}