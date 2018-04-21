<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/21
 * Time: 下午3:10
 */

namespace App\Models\Store;

use App\Models\Model;
use App\Traits\MongoTrait;
use EasySwoole\Core\Component\Di;

class DropStore extends Model
{
    use MongoTrait;

    private $uid;
    private $dropType = ['MenCloth','WomenCloth','BeautyShop','DepartmentStore','JewelryStore','ManDiscountShop','WomenDiscountShop'];
    private $shopType = 'ShopCenterType';

    public function __construct(Int $uid)
    {
        parent::__construct();
        $this->uid = $uid;
    }


    private function ()
    {

    }

}