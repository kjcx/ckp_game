<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 上午11:14
 */

namespace App\HttpController;

use App\Models\BagInfo\Bag;
use App\Models\Item\Item;
use App\Models\User\Role;
use App\Traits\MongoTrait;
use App\Utility\Mysql;
use EasySwoole\Config;
use EasySwoole\Core\Http\AbstractInterface\Controller;
use think\Db;

class Gm extends Controller
{

    /**
     * 获取用户
     */
    public function index()
    {
        $role = new Role();
        $roles = $role->getAllRole();
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write(json_encode($roles));
    }

    public function delUser()
    {
        $uid = $this->request()->getRequestParam('uid');

        $mysql = Mysql::getInstance()->getConnect();
        $dbConf = Config::getInstance()->getConf('MONGO');
        if (empty($dbConf['username'])) {
            $mongo = new \MongoDB\Client("mongodb://{$dbConf['hostname']}/");
        } else {
            $mongo = new \MongoDB\Client("mongodb://{$dbConf['username']}:{$dbConf['password']}@{$dbConf['hostname']}:{$dbConf['prot']}/");
        }
        $mysql->where('uid',$uid)->delete('ckzc_role');
        $mysql->where('uid',$uid)->delete('ckzc_userattr');
        $mysql->where('id',$uid)->delete('ckzc_member');
        $mysql->where('uid',$uid)->delete('ckzc_friend_apply');
        $mongo->ckzc_data->user_bag->deleteOne(['uid' => $uid]);
        $mongo->ckzc_data->manor->deleteOne(['uid' => $uid]);
        $response = ['code' => 200,'msg' => '成功'];
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write($response);
    }
    /**
     * 加等级
     */
    public function addLevel()
    {
        $uid = $this->request()->getRequestParam('uid');
        $level = $this->request()->getRequestParam('level');
        $role = new Role();
        if ($role->updateLevel($uid,$level))
        {
            $response = ['code' => 200,'msg' => '成功'];
        } else {
            $response = ['code' => 401,'msg' => '失败'];

        }
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write($response);

    }

    /**
     * 加全部道具
     */
    public function addAllItem()
    {

        $uid = $this->request()->getRequestParam('uid');
        $bag = new Bag($uid);

        $item = new Item();
        $items = $this->getAllItem();
        foreach ($items as $k => $v) {
            $bag->addBag($v['Id'],20);
        }
        
        $response = ['code' => 200,'msg' => '成功'];
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write(json_encode($response));
    }

    /**
     * 加经验
     */
    public function addExp()
    {
        $uid = $this->request()->getRequestParam('uid');
        $exp = $this->request()->getRequestParam('exp');
        $role = new Role();
        if ($role->updateExp($uid,$exp))
        {
            $response = ['code' => 200,'msg' => '成功'];
        } else {
            $response = ['code' => 401,'msg' => '失败'];

        }
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write(json_encode($response));
    }

    /**
     * 加道具
     */
    public function addItem()
    {
        $uid = $this->request()->getRequestParam('uid');
        $itemId = $this->request()->getRequestParam('itemId');
        $num = $this->request()->getRequestParam('num');

        $bag = new Bag($uid);

        if ($bag->addBag($itemId,$num))
        {
            $response = ['code' => 200,'msg' => '成功'];
        } else {
            $response = ['code' => 401,'msg' => '失败'];

        }
        $this->response()->withHeader("Content-Type","application/json; charset=utf-8");
        $this->response()->withHeader("Access-Control-Allow-Origin", "*");
        $this->response()->write(json_encode($response));
    }

    /**
     * 获取所有的商品
     */
    private function getAllItem()
    {
        $conf = Config::getInstance()->getConf('MONGO');
        if (empty($conf['username'])) {
            $mongo = new \MongoDB\Client("mongodb://{$conf['hostname']}/");
        } else {
            $mongo = new \MongoDB\Client("mongodb://{$conf['username']}:{$conf['password']}@{$conf['hostname']}:{$conf['prot']}/");
        }
        return $mongo->ckzc->item->find()->toArray();
    }
}