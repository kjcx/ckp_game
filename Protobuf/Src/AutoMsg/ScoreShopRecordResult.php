<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ScoreShopRecordResult</code>
 */
class ScoreShopRecordResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     */
    private $Type = 0;
    /**
     * Generated from protobuf field <code>int32 Score = 2;</code>
     */
    private $Score = 0;
    /**
     * Generated from protobuf field <code>int32 Value1 = 3;</code>
     */
    private $Value1 = 0;
    /**
     * Generated from protobuf field <code>int32 Value2 = 4;</code>
     */
    private $Value2 = 0;
    /**
     * Generated from protobuf field <code>int32 Value3 = 5;</code>
     */
    private $Value3 = 0;
    /**
     * Generated from protobuf field <code>int32 Time = 6;</code>
     */
    private $Time = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     * @return int
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkInt32($var);
        $this->Type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Score = 2;</code>
     * @return int
     */
    public function getScore()
    {
        return $this->Score;
    }

    /**
     * Generated from protobuf field <code>int32 Score = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setScore($var)
    {
        GPBUtil::checkInt32($var);
        $this->Score = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Value1 = 3;</code>
     * @return int
     */
    public function getValue1()
    {
        return $this->Value1;
    }

    /**
     * Generated from protobuf field <code>int32 Value1 = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setValue1($var)
    {
        GPBUtil::checkInt32($var);
        $this->Value1 = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Value2 = 4;</code>
     * @return int
     */
    public function getValue2()
    {
        return $this->Value2;
    }

    /**
     * Generated from protobuf field <code>int32 Value2 = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setValue2($var)
    {
        GPBUtil::checkInt32($var);
        $this->Value2 = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Value3 = 5;</code>
     * @return int
     */
    public function getValue3()
    {
        return $this->Value3;
    }

    /**
     * Generated from protobuf field <code>int32 Value3 = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setValue3($var)
    {
        GPBUtil::checkInt32($var);
        $this->Value3 = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Time = 6;</code>
     * @return int
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * Generated from protobuf field <code>int32 Time = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->Time = $var;

        return $this;
    }

}

