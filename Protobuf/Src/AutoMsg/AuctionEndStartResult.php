<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AuctionEndStartResult</code>
 */
class AuctionEndStartResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bool EndIsStart = 1;</code>
     */
    private $EndIsStart = false;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>bool EndIsStart = 1;</code>
     * @return bool
     */
    public function getEndIsStart()
    {
        return $this->EndIsStart;
    }

    /**
     * Generated from protobuf field <code>bool EndIsStart = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setEndIsStart($var)
    {
        GPBUtil::checkBool($var);
        $this->EndIsStart = $var;

        return $this;
    }

}
