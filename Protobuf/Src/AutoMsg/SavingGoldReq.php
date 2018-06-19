<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.SavingGoldReq</code>
 */
class SavingGoldReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 GoldType = 1;</code>
     */
    private $GoldType = 0;
    /**
     * Generated from protobuf field <code>int64 GoldCount = 2;</code>
     */
    private $GoldCount = 0;
    /**
     * Generated from protobuf field <code>int32 SaveType = 3;</code>
     */
    private $SaveType = 0;
    /**
     * Generated from protobuf field <code>int32 TimeLimit = 4;</code>
     */
    private $TimeLimit = 0;
    /**
     *存款时间id
     *
     * Generated from protobuf field <code>int64 TimeLimitId = 5;</code>
     */
    private $TimeLimitId = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 GoldType = 1;</code>
     * @return int
     */
    public function getGoldType()
    {
        return $this->GoldType;
    }

    /**
     * Generated from protobuf field <code>int32 GoldType = 1;</code>
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
     * Generated from protobuf field <code>int64 GoldCount = 2;</code>
     * @return int|string
     */
    public function getGoldCount()
    {
        return $this->GoldCount;
    }

    /**
     * Generated from protobuf field <code>int64 GoldCount = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setGoldCount($var)
    {
        GPBUtil::checkInt64($var);
        $this->GoldCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SaveType = 3;</code>
     * @return int
     */
    public function getSaveType()
    {
        return $this->SaveType;
    }

    /**
     * Generated from protobuf field <code>int32 SaveType = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setSaveType($var)
    {
        GPBUtil::checkInt32($var);
        $this->SaveType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 TimeLimit = 4;</code>
     * @return int
     */
    public function getTimeLimit()
    {
        return $this->TimeLimit;
    }

    /**
     * Generated from protobuf field <code>int32 TimeLimit = 4;</code>
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
     *存款时间id
     *
     * Generated from protobuf field <code>int64 TimeLimitId = 5;</code>
     * @return int|string
     */
    public function getTimeLimitId()
    {
        return $this->TimeLimitId;
    }

    /**
     *存款时间id
     *
     * Generated from protobuf field <code>int64 TimeLimitId = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimeLimitId($var)
    {
        GPBUtil::checkInt64($var);
        $this->TimeLimitId = $var;

        return $this;
    }

}

