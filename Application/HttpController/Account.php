<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/2
 * Time: 下午4:39
 * 赵
 */
namespace App\HttpController;

use EasySwoole\Config;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use GuzzleHttp\Client;
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
        //游戏查询app_token 看看是否存在
        $Account = new \App\Models\User\Account();
        $rs = $Account->check_app_token($key);
        var_dump("check_app_token" . $key .'=>' .$rs);
        if($rs){
            $uid = $rs['id'];
        }else{
            $res = $client->request('POST',$url,['form_params'=>['key'=>$key]]);
            $str = $res->getBody()->getContents();
            $arr = json_decode($str,1);

            if($arr['code'] == 200) {
                $member_info = $arr['datas']['member_info'];
                //查询用户是否存在
                $Account = new \App\Models\User\Account();
                $where = 'member_mobile = ' . $member_info['member_mobile'];
                $rs = $Account->find($where);
                if ($rs) {
                    //用户存在 返回用户信息
                    //生产token 并返回
                    $uid = $rs['id'];
//                $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
//                $this->response()->write(json_encode($member_info));
//                $res = $Account->update("id=$uid",['app_token'=>$key]);
                } else {
                    $data = [
                        'user_name' => $member_info['user_name'],
                        'member_mobile' => $member_info['member_mobile'],
                        'game_level' => $member_info['game_level'],
                        'game_level_name' => $member_info['game_level_name'],
                        'avatar' => $member_info['avatar'],//app头像
                        'create_time' => time(),
                        'update_time' => time(),
                        'app_token' => $key,
                    ];
                    $uid = $Account->insert($data);
                }
            }else{
                $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
                $this->response()->withHeader("Access-Control-Allow-Origin", "*");
                $this->response()->withStatus(500);
                $this->response()->write(json_encode(['msg'=>'token失效']));
            }
        }

        var_dump($uid);
        if($uid){
            //生产token 并返回
            $token = $Account->crateToken($uid);
            var_dump($token);
            if($token){
                $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
                $this->response()->withHeader("Access-Control-Allow-Origin", "*");
                $return['data']['token'] = $token;
                $return['msg']  = 'success';
                $this->response()->write(json_encode($return));
            }
        }else{
            $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
//                $this->response()->withStatus(200);
            $this->response()->write(json_encode(['msg'=>'插入失败']));
        }

    }

    function index()
    {
        // TODO: Implement index() method.
    }
}
