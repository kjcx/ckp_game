<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/3
 * Time: 下午6:17
 */
namespace App\Model;
use App\Model\Model;
use EasySwoole\Core\Component\Di;
class Common extends Model
{
    private $Di;
    function __construct()
    {
        $db = Di::getInstance()->get('MYSQL');
        $this->Di = $db;
    }
}