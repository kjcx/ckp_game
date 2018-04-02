<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.SavingInfo</code>
 */
class SavingInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 SavingType = 1;</code>
     */
    private $SavingType = 0;
    /**
     * Generated from protobuf field <code>int32 SavingTime = 2;</code>
     */
    private $SavingTime = 0;
    /**
     * Generated from protobuf field <code>int32 TimeLimit = 3;</code>
     */
    private $TimeLimit = 0;
    /**
     * Generated from protobuf field <code>double GoldCount = 4;</code>
     */
    private $GoldCount = 0.0;
    /**
     * Generated from protobuf field <code>int32 GoldType = 5;</code>
     */
    private $GoldType = 0;
    /**
     * Generated from protobuf field <code>double SavingInst = 6;</code>
     */
    private $SavingInst = 0.0;
    /**
     * Generated from protobuf field <code>int32 LoadingTime = 7;</code>
     */
    private $LoadingTime = 0;
    /**
     * Generated from protobuf field <code>string Id = 8;</code>
     */
    private $Id = '';
    /**
     * Generated from protobuf field <code>double Earnings = 9;</code>
     */
    private $Earnings = 0.0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 SavingType = 1;</code>
     * @return int
     */
    public function getSavingType()
    {
        return $this->SavingType;
    }

    /**
     * Generated from protobuf field <code>int32 SavingType = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setSavingType($var)
    {
        GPBUtil::checkInt32($var);
        $this->SavingType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SavingTime = 2;</code>
     * @return int
     */
    public function getSavingTime()
    {
        return $this->SavingTime;
    }

    /**
     * Generated from protobuf field <code>int32 SavingTime = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setSavingTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->SavingTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 TimeLimit = 3;</code>
     * @return int
     */
    public function getTimeLimit()
    {
        return $this->TimeLimit;
    }

    /**
     * Generated from protobuf field <code>int32 TimeLimit = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setTimeLimit($var)
    {
        GPBUtil::checkInt32($var);
        $this->TimeLimit = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double GoldCount = 4;</code>
     * @return float
     */
    public function getGoldCount()
    {
        return $this->GoldCount;
    }

    /**
     * Generated from protobuf field <code>double GoldCount = 4;</code>
     * @param float $var
     * @return $this
     */
    public function setGoldCount($var)
    {
        GPBUtil::checkDouble($var);
        $this->GoldCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 GoldType = 5;</code>
     * @return int
     */
    public function getGoldType()
    {
        return $this->GoldType;
    }

    /**
     * Generated from protobuf field <code>int32 GoldType = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setGoldType($var)
    {
        GPBUtil::checkInt32($var);
        $this->GoldType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double SavingInst = 6;</code>
     * @return float
     */
    public function getSavingInst()
    {
        return $this->SavingInst;
    }

    /**
     * Generated from protobuf field <code>double SavingInst = 6;</code>
     * @param float $var
     * @return $this
     */
    public function setSavingInst($var)
    {
        GPBUtil::checkDouble($var);
        $this->SavingInst = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 LoadingTime = 7;</code>
     * @return int
     */
    public function getLoadingTime()
    {
        return $this->LoadingTime;
    }

    /**
     * Generated from protobuf field <code>int32 LoadingTime = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setLoadingTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->LoadingTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Id = 8;</code>
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>string Id = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->Id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double Earnings = 9;</code>
     * @return float
     */
    public function getEarnings()
    {
        return $this->Earnings;
    }

    /**
     * Generated from protobuf field <code>double Earnings = 9;</code>
     * @param float $var
     * @return $this
     */
    public function setEarnings($var)
    {
        GPBUtil::checkDouble($var);
        $this->Earnings = $var;

        return $this;
    }

}
