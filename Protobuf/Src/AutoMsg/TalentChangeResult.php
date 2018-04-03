<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TalentChangeResult</code>
 */
class TalentChangeResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>int64 Score = 2;</code>
     */
    private $Score = 0;
    /**
     * Generated from protobuf field <code>bool Status = 3;</code>
     */
    private $Status = false;
    /**
     * Generated from protobuf field <code>string ShopId = 4;</code>
     */
    private $ShopId = '';
    /**
     * Generated from protobuf field <code>string Company = 5;</code>
     */
    private $Company = '';
    /**
     * Generated from protobuf field <code>string CompanyUserName = 6;</code>
     */
    private $CompanyUserName = '';

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
     * Generated from protobuf field <code>int64 Score = 2;</code>
     * @return int|string
     */
    public function getScore()
    {
        return $this->Score;
    }

    /**
     * Generated from protobuf field <code>int64 Score = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setScore($var)
    {
        GPBUtil::checkInt64($var);
        $this->Score = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Status = 3;</code>
     * @return bool
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>bool Status = 3;</code>
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
     * Generated from protobuf field <code>string ShopId = 4;</code>
     * @return string
     */
    public function getShopId()
    {
        return $this->ShopId;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 4;</code>
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
     * Generated from protobuf field <code>string Company = 5;</code>
     * @return string
     */
    public function getCompany()
    {
        return $this->Company;
    }

    /**
     * Generated from protobuf field <code>string Company = 5;</code>
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
     * Generated from protobuf field <code>string CompanyUserName = 6;</code>
     * @return string
     */
    public function getCompanyUserName()
    {
        return $this->CompanyUserName;
    }

    /**
     * Generated from protobuf field <code>string CompanyUserName = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setCompanyUserName($var)
    {
        GPBUtil::checkString($var, True);
        $this->CompanyUserName = $var;

        return $this;
    }

}

