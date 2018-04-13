<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/10
 * Time: 下午1:19
 * 背包类
 */

namespace App\Models\BagInfo;

use App\Models\Model;

class Bag extends Model
{
    private $uid;
    private $bagId;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *增加格子数量
     */
    public function addLattices()
    {

    }

    /**
     * 验证叠加数量
     */
    public function checkOverlyingNum($itemsId)
    {
        
    }


}