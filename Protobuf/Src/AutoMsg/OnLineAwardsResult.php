<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.OnLineAwardsResult</code>
 */
class OnLineAwardsResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.OnLineAwardsInfo onLineAward = 1;</code>
     */
    private $onLineAward = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.OnLineAwardsInfo onLineAward = 1;</code>
     * @return \AutoMsg\OnLineAwardsInfo
     */
    public function getOnLineAward()
    {
        return $this->onLineAward;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.OnLineAwardsInfo onLineAward = 1;</code>
     * @param \AutoMsg\OnLineAwardsInfo $var
     * @return $this
     */
    public function setOnLineAward($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\OnLineAwardsInfo::class);
        $this->onLineAward = $var;

        return $this;
    }

}

