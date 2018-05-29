<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/21
 * Time: 下午3:23
 */

namespace App\Traits;

use App\Models\BagInfo\Bag;
use App\Models\User\Role;

trait UserTrait
{
    public $uid;
    public $roleInfo;
    private $bagObj;
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

    public function setRoleInfo()
    {
        $this->roleInfo = (new Role())->getRole($this->getUid());
    }

    public function getBag()
    {
        if (!is_object($this->bagObj)) {
            $this->bagObj = new Bag($this->getUid());
        }
        return $this->bagObj;
    }
}