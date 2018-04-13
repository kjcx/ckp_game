<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:35
 */
namespace App\Event;
use Symfony\Component\EventDispatcher\Event;

class BookEvent extends Event
{
    public $name = self::class;
    public function __construct($arr)
    {
        $this->name = $arr;
    }
}