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
    private $bagInfo;
    private $item; //item类为了验证信息   依赖

    private $mysqlTable = 'ckzc_bag'; //
    public function __construct(int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
        $this->bagInfo = $this->getBag();

        //依赖进来 但是不需要注入
        $this->item = new Item();
    }

    /**
     * 获取背包信息
     * @return array|bool
     */
    private function getBag()
    {
        $data = $this->mysql->where('uid' , $this->uid)->getOne($this->mysqlTable);
        if (!empty($data)) {
            return $data;
        }
        return false;
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

    /**
     * 获取背包数量
     */
    public function getBagNum()
    {
        
    }


    

}