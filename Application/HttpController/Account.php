<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:39
 */
namespace App\HttpController;

use EasySwoole\Config;
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
        $url = Config::getInstance()->getConf('APP.member_info');
        $key = $this->request()->getQueryParam('key');
        var_dump("=============开始请求==========".time());
        $res = $client->request('POST',$url,['form_params'=>['key'=>$key]]);

        $str = $res->getBody()->getContents();
        $arr = json_decode($str,1);
        var_dump($arr);

        var_dump("=============结束请求==========".time());

        if($arr['code'] == 200){
            $member_info = $arr['datas']['member_info'];
            //查询用户是否存在
            $Account = new \App\Models\User\Account();
            $where  = 'member_mobile = ' . $member_info['member_mobile'];
            $rs = $Account->find($where);
//            var_dump($rs);
            if($rs){
                //用户存在 返回用户信息
                //生产token 并返回
                $uid = $rs['id'];
//                $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
//                $this->response()->write(json_encode($member_info));
            }else{
                $data = [
                    'user_name'=>$member_info['user_name'],
                    'member_mobile'=>$member_info['member_mobile'],
                    'game_level'=>$member_info['game_level'],
                    'game_level_name'=>$member_info['game_level_name'],
                    'avatar'=>$member_info['avatar'],
                    'create_time'=>time(),
                    'update_time'=>time()
                ];
                $uid = $Account->insert($data);
            }
            if($uid){
                //生产token 并返回
                $token = $Account->crateToken($uid);
                if($token){
                    $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
                    $return['data']['token'] = $token;
                    $return['msg']  = 'success';
                    $this->response()->write(json_encode($return));
                }
            }else{
                $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
//                $this->response()->withStatus(200);
                $this->response()->write(json_encode(['msg'=>'插入失败']));
            }
        }else{
            $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
            $this->response()->withStatus(500);
            $this->response()->write(json_encode(['msg'=>'token失效']));
        }
    }

    function index()
    {
        // TODO: Implement index() method.
    }
}
