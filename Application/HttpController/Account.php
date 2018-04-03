<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:39
 */
namespace App\HttpController;

use EasySwoole\Core\Http\AbstractInterface\Controller;
use GuzzleHttp\Client;
use EasySwoole\Core\Component\Di;
class Account extends Controller
{
    /**
     * CKLogin 游戏登录接口
     * key token
     */
    public function CKLogin(){
        $client = new Client();
        $url = 'http://www.ckp520.com/mobile/index.php?act=member_index';
        $key = $this->request()->getQueryParam('key');
        $res = $client->request('POST',$url,['form_params'=>['key'=>$key]]);
        $str = $res->getBody()->getContents();
        $arr = json_decode($str,1);

//            $this->response()->write(1111);
        if($arr['code'] == 200){
//            var_dump($arr);
            $member_info = $arr['datas']['member_info'];
//            $this->response()->write(\GuzzleHttp\json_encode($arr['datas']));
            $db = Di::getInstance()->get('MYSQL');
            //查询用户是否存在
            $rs = $db->getOne('ckzc_member',['member_mobie'=>$member_info['member_mobile']]);
            if($rs){
                //用户存在 返回用户信息
                $this->response()->write(\GuzzleHttp\json_encode($member_info));
            }else{
                $data = [
                    'user_name'=>$member_info['user_name'],
                    'member_mobile'=>$member_info['member_mobile'],
                    'sex'=>$member_info['sex'],
                    'nickname'=>$member_info['nickname'],
                    'game_level'=>$member_info['game_level'],
                    'game_level_name'=>$member_info['game_level_name'],
                    'avatar'=>$member_info['avatar'],
                    'create_time'=>time(),
                    'update_time'=>time()
                ];
                $id = $db->insert("ckzc_member", $data);
                if($id){
//                    $this->respone()->write('插入成功');
                    $this->response()->write(\GuzzleHttp\json_encode($member_info));
                }else{
                    $this->response()->write('插入失败');
                }
            }
        }else{
            $this->response()->write($str);
        }
    }

    function index()
    {
        // TODO: Implement index() method.
    }
}
