<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TalentInfo</code>
 */
class TalentInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     */
    private $Icon = '';
    /**
     * Generated from protobuf field <code>int64 SocialStatus = 4;</code>
     */
    private $SocialStatus = 0;
    /**
     * Generated from protobuf field <code>bool Status = 5;</code>
     */
    private $Status = false;
    /**
     * Generated from protobuf field <code>int32 Level = 6;</code>
     */
    private $Level = 0;
    /**
     * Generated from protobuf field <code>string Company = 7;</code>
     */
    private $Company = '';
    /**
     * Generated from protobuf field <code>int32 DigCount = 8;</code>
     */
    private $DigCount = 0;
    /**
     * Generated from protobuf field <code>string ShopId = 9;</code>
     */
    private $ShopId = '';
    /**
     * Generated from protobuf field <code>int32 LandPos = 10;</code>
     */
    private $LandPos = 0;
    /**
     * Generated from protobuf field <code>int32 HireTime = 11;</code>
     */
    private $HireTime = 0;
    /**
     * Generated from protobuf field <code>string CompanyUserName = 12;</code>
     */
    private $CompanyUserName = '';
    /**
     * Generated from protobuf field <code>string HireRoleId = 13;</code>
     */
    private $HireRoleId = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRoleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->RoleId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->Name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     * @return string
     */
    public function getIcon()
    {
        return $this->Icon;
    }

    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setIcon($var)
    {
        GPBUtil::checkString($var, True);
        $this->Icon = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 SocialStatus = 4;</code>
     * @return int|string
     */
    public function getSocialStatus()
    {
        return $this->SocialStatus;
    }

    /**
     * Generated from protobuf field <code>int64 SocialStatus = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setSocialStatus($var)
    {
        GPBUtil::checkInt64($var);
        $this->SocialStatus = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Status = 5;</code>
     * @return bool
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>bool Status = 5;</code>
     * @param bool $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkBool($var);
        $this->Status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 6;</code>
     * @return int
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setLevel($var)
    {
        GPBUtil::checkInt32($var);
        $this->Level = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Company = 7;</code>
     * @return string
     */
    public function getCompany()
    {
        return $this->Company;
    }

    /**
     * Generated from protobuf field <code>string Company = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setCompany($var)
    {
        GPBUtil::checkString($var, True);
        $this->Company = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 DigCount = 8;</code>
     * @return int
     */
    public function getDigCount()
    {
        return $this->DigCount;
    }

    /**
     * Generated from protobuf field <code>int32 DigCount = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setDigCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->DigCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 9;</code>
     * @return string
     */
    public function getShopId()
    {
        return $this->ShopId;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setShopId($var)
    {
        GPBUtil::checkString($var, True);
        $this->ShopId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 LandPos = 10;</code>
     * @return int
     */
    public function getLandPos()
    {
        return $this->LandPos;
    }

    /**
     * Generated from protobuf field <code>int32 LandPos = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setLandPos($var)
    {
        GPBUtil::checkInt32($var);
        $this->LandPos = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 HireTime = 11;</code>
     * @return int
     */
    public function getHireTime()
    {
        return $this->HireTime;
    }

    /**
     * Generated from protobuf field <code>int32 HireTime = 11;</code>
     * @param int $var
     * @return $this
     */
    public function setHireTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->HireTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string CompanyUserName = 12;</code>
     * @return string
     */
    public function getCompanyUserName()
    {
        return $this->CompanyUserName;
    }

    /**
     * Generated from protobuf field <code>string CompanyUserName = 12;</code>
     * @param string $var
     * @return $this
     */
    public function setCompanyUserName($var)
    {
        GPBUtil::checkString($var, True);
        $this->CompanyUserName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string HireRoleId = 13;</code>
     * @return string
     */
    public function getHireRoleId()
    {
        return $this->HireRoleId;
    }

    /**
     * Generated from protobuf field <code>string HireRoleId = 13;</code>
     * @param string $var
     * @return $this
     */
    public function setHireRoleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->HireRoleId = $var;

        return $this;
    }

}
