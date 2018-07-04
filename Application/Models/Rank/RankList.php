<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午3:34
 */

namespace App\Models\Rank;


use App\Models\Model;
use App\Utility\Cache;

class RankList extends Model
{
    private $cache;

    const Income = 1;//身价排行榜
    const CompanyLv = 2;//公司级别排行榜
    const GoldCount = 3;//持有创客币数量排行榜
    const Feeling = 4;//好感度排行榜
    const PKWin = 5;//谈判排行

    public function __construct()
    {
        $this->cache = Cache::getInstance();
    }


    public function getData()
    {
        $data = [
            '0' => 1
        ];
        for ($i = 1; $i < 11; $i++) {
            $data[] = [
                'rank'   => $i,
                'value'  =>2,
                'value1' =>3,
                'value2' =>4,
                'value3' =>5,
                'uid' => $i,
                'name'   => 'tttaaa',
                'icon'   =>'npc_1001',
            ];
        }
        unset($data['0']);
        return $data;
    }
}