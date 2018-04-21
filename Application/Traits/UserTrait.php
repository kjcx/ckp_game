<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/21
 * Time: 下午3:23
 */

namespace App\Traits;

trait UserTrait
{
    public $uid;

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid): void
    {
        $this->uid = $uid;
    }

}