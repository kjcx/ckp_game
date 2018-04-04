<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:18
 */
namespace App\HttpController;
use App\Models\User\Role;
use AutoMsg\MsgBaseSend;
use EasySwoole\Core\Http\AbstractInterface\Controller;
class Index extends Controller
{
    public function index()
    {
        $Role = new Role();
        $arr = $Role->getRole(2);
        $this->response()->write(json_encode($arr));
    }
}