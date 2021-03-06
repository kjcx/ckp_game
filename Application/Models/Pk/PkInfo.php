<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/3
 * Time: 下午5:20
 */

namespace App\Models\Pk;


use App\Models\Model;
use App\Models\User\Role;
use App\Utility\Cache;

class PkInfo extends Model
{
    public $cache;
    public $Pk = 'PkRanking';
    public $WaitPk = 'WaitPk';
    public function __construct()
    {
        $this->cache = Cache::getInstance();
    }

    /**
     * 获取排行榜数据
     * @param $Uid
     * @return array
     */
    public function getRanking($Uid)
    {
        $key = $this->Pk;
        $arr = $this->cache->client()->zRevRange($key,0,9,'WITHSCORES');
        $MyRank = $this->getUserRank($Uid);
        $Role = new Role();
        $i = 1;
        $list = [];
        foreach ($arr as $k => $v) {
            //获取用户信息
            $info = $Role->getRole($k);
            $Name = $info['nickname'];
            $Shenjiazhi = $info['shenjiazhi'];

            $Score = $v;
            $Ranking =$i;
            $list[$i] = ['Ranking'=>$Ranking,'Name'=>$Name,'Shenjiazhi'=>$Shenjiazhi,'Score'=>$Score];
            $i++;

        }
        $UserInfo = $Role->getRole($Uid);
        $Score = $this->getUserScore($Uid);
        if($Score){
            $list[$MyRank] = ['Ranking'=>$MyRank,'Name'=>$UserInfo['nickname'],'Shenjiazhi'=>$UserInfo['shenjiazhi'],'Score'=>$Score];
        }else{
            return $list;
        }

    }

    /**
     * 设置排名
     * @param $Uid
     * @param $Score
     */
    public function setRanking($Uid,$Score)
    {
        $key = $this->Pk;
        $arr = $this->cache->client('write')->zAdd($key,$Score,$Uid);

    }

    /**
     * 获取自己排名
     * @param $Uid
     * @return int
     */
    public function getUserRank($Uid)
    {
        $key = $this->Pk;
        $num = $this->cache->client()->zRank($key,$Uid);
        return $num;
    }

    /**
     * 返回成员分数
     * @param $Uid
     * @return float
     */
    public function getUserScore($Uid)
    {
        $key = $this->Pk;
        $Score = $this->cache->client()->zScore($key,$Uid);
        return $Score;
    }

    /**
     * 获取本人参赛数量
     * @param $Uid
     * @return int
     */
    public function getCount($Uid)
    {
        return 1;
    }

    /**
     * 匹配玩家
     */
    public function Pipei($Uid)
    {
        $key = $this->WaitPk;
        $this->cache->client('write')->rPush($key,$Uid);
        return true;
    }

    public function Lpop()
    {
        $key = $this->WaitPk;
        $uid = $this->cache->client()->lPop($key);
        
    }
    
}