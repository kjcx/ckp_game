<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午8:36
 * 种子商店
 */

namespace App\Models\Store;


use App\Models\BagInfo\Bag;
use App\Models\Item\Item;
use App\Models\Model;
use App\Traits\MongoTrait;
use App\Traits\UserTrait;

class Seed extends Model
{
    use MongoTrait,UserTrait;

    private $item;

    public function __construct($uid)
    {
        parent::__construct();
        $this->setUid($uid);
        $this->setRoleInfo();
        $this->item = new Item();
    }

    /**
     * 购买种子
     */
    public function buy($itemId,$num)
    {
        $seedInfo = $this->item->getItemById($itemId);
        $checkLevel = $this->checkLevel($seedInfo); //验证等级
        if (is_string($checkLevel)) {
            return ['error' => true,'msg' => $checkLevel];
        }
        $checkMoney = $this->checkMoney($seedInfo,$num); //验证金钱
        if (is_string($checkMoney)) {
            return ['error' => true,'msg' => $checkMoney];
        }
        $purchaseType = explode(',',$seedInfo['Cost']);
        //先减钱
        $price = $num * $purchaseType['1'];
        $this->getBag()->delBag($purchaseType['0'],$price);
        //加种子
        $bagAdd = $this->getBag()->addBag($itemId,$num);
        if (is_string($bagAdd)) {
            return ['error' => true,'msg' => $bagAdd];
        }
        return ['itemId' => $itemId,'itemCount' => $num,'price' => $price];
    }

    /**
     * 验证等级
     */
    private function checkLevel($seedData)
    {
        if ($this->roleInfo['level'] >= $seedData['Level']) {
            return true;
        }
        return 'NeedLevel';
    }

    /**
     *验证钱是否够
     */
    private function checkMoney($seedData,$num)
    {
        $bag = new Bag($this->getUid());
        $purchaseType = explode(',',$seedData['Cost']);
        $price = $purchaseType['1'] * $num;
        $money = $bag->getBagByItemId($purchaseType['0']);
        if (empty($money) || $money['CurCount'] < $price) {
            return 'NotEnoughMoney';
        }
        return true;
    }

}