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
        $arr = $this->cache->client()->zRange($key,0,9);

        $MyRank = $this->getUserRank($Uid);
        $Role = new Role();
        $i = 1;
        $list = [];
        foreach ($arr as $k => $v) {
            //获取用户信息
            $info = $Role->getRole($v);
            $Name = $info['nickname'];
            $Shenjiazhi = $info['shenjiazhi'];
            $Score = $k;
            $Ranking =$i;
            $i++;
            $list[$i] = ['Ranking'=>$Ranking,'Name'=>$Name,'Shenjiazhi'=>$Shenjiazhi,'Score'=>$Score];
        }
        $UserInfo = $Role->getRole($Uid);
        $Score = $this->getUserScore($Uid);
        if($Score){
            $list[$MyRank] = ['Ranking'=>$MyRank,'Name'=>$UserInfo['nickname'],'Shenjiazhi'=>$UserInfo['shenjiazhi'],'Score'=>$Score];
            return $list;
        }else{
            return [];
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
        var_dump($num);
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
}