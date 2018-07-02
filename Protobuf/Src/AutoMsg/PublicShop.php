<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.PublicShop</code>
 */
class PublicShop extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     */
    private $BuildId = '';
    /**
     * Generated from protobuf field <code>int32 BuildType = 2;</code>
     */
    private $BuildType = 0;
    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>int64 CurrSellPrice = 4;</code>
     */
    private $CurrSellPrice = 0;
    /**
     * Generated from protobuf field <code>int64 StartCurrSellPrice = 5;</code>
     */
    private $StartCurrSellPrice = 0;
    /**
     * Generated from protobuf field <code>string RoleId = 6;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>int32 CurExtendLv = 7;</code>
     */
    private $CurExtendLv = 0;
    /**
     * Generated from protobuf field <code>int32 ShopLevel = 8;</code>
     */
    private $ShopLevel = 0;
    /**
     * Generated from protobuf field <code>int32 Pos = 9;</code>
     */
    private $Pos = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     * @return string
     */
    public function getBuildId()
    {
        return $this->BuildId;
    }

    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setBuildId($var)
    {
        GPBUtil::checkString($var, True);
        $this->BuildId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 BuildType = 2;</code>
     * @return int
     */
    public function getBuildType()
    {
        return $this->BuildType;
    }

    /**
     * Generated from protobuf field <code>int32 BuildType = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setBuildType($var)
    {
        GPBUtil::checkInt32($var);
        $this->BuildType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 3;</code>
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
     * Generated from protobuf field <code>int64 CurrSellPrice = 4;</code>
     * @return int|string
     */
    public function getCurrSellPrice()
    {
        return $this->CurrSellPrice;
    }

    /**
     * Generated from protobuf field <code>int64 CurrSellPrice = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setCurrSellPrice($var)
    {
        GPBUtil::checkInt64($var);
        $this->CurrSellPrice = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 StartCurrSellPrice = 5;</code>
     * @return int|string
     */
    public function getStartCurrSellPrice()
    {
        return $this->StartCurrSellPrice;
    }

    /**
     * Generated from protobuf field <code>int64 StartCurrSellPrice = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setStartCurrSellPrice($var)
    {
        GPBUtil::checkInt64($var);
        $this->StartCurrSellPrice = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 6;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 6;</code>
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
     * Generated from protobuf field <code>int32 CurExtendLv = 7;</code>
     * @return int
     */
    public function getCurExtendLv()
    {
        return $this->CurExtendLv;
    }

    /**
     * Generated from protobuf field <code>int32 CurExtendLv = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setCurExtendLv($var)
    {
        GPBUtil::checkInt32($var);
        $this->CurExtendLv = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ShopLevel = 8;</code>
     * @return int
     */
    public function getShopLevel()
    {
        return $this->ShopLevel;
    }

    /**
     * Generated from protobuf field <code>int32 ShopLevel = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setShopLevel($var)
    {
        GPBUtil::checkInt32($var);
        $this->ShopLevel = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Pos = 9;</code>
     * @return int
     */
    public function getPos()
    {
        return $this->Pos;
    }

    /**
     * Generated from protobuf field <code>int32 Pos = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setPos($var)
    {
        GPBUtil::checkInt32($var);
        $this->Pos = $var;

        return $this;
    }

}

