<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午3:34
 */

namespace App\Models\Rank;


use App\Models\Model;
use App\Models\User\Role;
use App\Utility\Cache;

class RankList extends Model
{
    private $cache;
    private $rankListKeys = [];//排行榜key
    private $rankListQueue = [];//排行榜队列
    private $rankType = [1,2,3,4,5];
    private $role;

    const Income = 1;//身价排行榜
    const CompanyLv = 2;//公司级别排行榜
    const GoldCount = 3;//持有创客币数量排行榜
    const Feeling = 4;//好感度排行榜
    const PKWin = 5;//谈判排行

    const max = 200;//最大取200名

    public function __construct()
    {
        $this->cache = Cache::getInstance();
        $this->role = new Role();
        foreach ($this->rankType as $type) {
            $this->rankListKeys[$type] = 'rankList:type:' . $type;
            $this->rankListQueue[$type] = 'rankQueue:type:' . $type;
        }
    }

    /**
     * 获取排行榜
     * @param $type 排行榜类型
     * @return array
     */
    public function getRankList($type)
    {
        //结构体的bug
        $data = [
            '0' => 1
        ];
        if (!isset($this->rankListKeys[$type])) {
            //没有排行榜类型 返回false
            return false;
        }
        $rankKey = $this->rankListKeys[$type];
        $rankList = $this->cache->client()->zRevRange($rankKey,0,self::max);
        foreach ($rankList as $k => $rank) {
            $roleInfo = $this->role->getRole($rank);
            $data[] = [
                'rank'   => $k + 1, //排名
                'level'  => $roleInfo['level'], //等级
                'income' => 3,//收入
                'commercename' => '',//商会名字 todo::暂时没有
                'win' => $roleInfo['win'],//胜率
                'uid' => $roleInfo['uid'],//uid
                'name'   => $roleInfo['nickname'],//名字
                'icon'   => $roleInfo['icon'],//头像
                'pkcount'   => $roleInfo['pkcount'],//头像 todo::对战次数
            ];
        }

        unset($data['0']);
        return $data;
    }

    /**
     * 设置排行榜到队列中
     * 因为排行榜不是实时更新 并且排行榜添加的时候可能非常耗费cpu 所以推送到队列中 定时 没人时候执行
     * @param $uid
     * @param $type
     * @param $score
     * @return bool
     */
    public function setRankToQueue($uid,$type,$score)
    {
        if (!isset($this->rankListQueue[$type])) {
            //没有排行榜类型 返回false
            return false;
        }
        $this->cache->hashSet($this->rankListQueue[$type],$uid,$score,false);
        return true;
    }
    /**
     * 测试使用
     * @param $type
     * @return array|bool
     */
    public function getData($type)
    {
        //结构体的bug
        $data = [
            '0' => 1
        ];
        if (!isset($this->rankListKeys[$type])) {
            //没有排行榜类型 返回false
            return false;
        }

        for ($i = 1; $i < 201; $i++) {
//            $roleInfo = $this->role->getRole($rank);
            $data[] = [
                'rank'   => $i, //排名
                'level'  => 1, //等级
                'income' => 3,//收入
                'commercename' => '测试商会',//商会名字 todo::暂时没有
                'win' => '100',//胜率
                'uid' => 55,//uid
                'name'   => 'test',//名字
                'icon'   => 'npc_1001',//头像
                'pkcount'   => 5,//头像 todo::对战次数
            ];
        }

        unset($data['0']);
        return $data;
    }
}