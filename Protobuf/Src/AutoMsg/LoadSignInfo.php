<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadSignInfo</code>
 */
class LoadSignInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Day = 1;</code>
     */
    private $Day = 0;
    /**
     * Generated from protobuf field <code>bool IsSign = 2;</code>
     */
    private $IsSign = false;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Day = 1;</code>
     * @return int
     */
    public function getDay()
    {
        return $this->Day;
    }

    /**
     * Generated from protobuf field <code>int32 Day = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setDay($var)
    {
        GPBUtil::checkInt32($var);
        $this->Day = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool IsSign = 2;</code>
     * @return bool
     */
    public function getIsSign()
    {
        return $this->IsSign;
    }

    /**
     * Generated from protobuf field <code>bool IsSign = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsSign($var)
    {
        GPBUtil::checkBool($var);
        $this->IsSign = $var;

        return $this;
    }

}
