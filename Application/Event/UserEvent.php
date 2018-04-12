<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:12
 */
namespace App\Event;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
class UserEvent extends Event
{
    public function name()
    {
        return "Cartman";
    }

    public function age()
    {
        return "24";
    }
}