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

    public function __construct()
    {
        parent::__construct();
    }


}