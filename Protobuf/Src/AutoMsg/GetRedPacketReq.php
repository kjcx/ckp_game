<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.GetRedPacketReq</code>
 */
class GetRedPacketReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRedPacket loadRedPacket = 1;</code>
     */
    private $loadRedPacket = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRedPacket loadRedPacket = 1;</code>
     * @return \AutoMsg\LoadRedPacket
     */
    public function getLoadRedPacket()
    {
        return $this->loadRedPacket;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRedPacket loadRedPacket = 1;</code>
     * @param \AutoMsg\LoadRedPacket $var
     * @return $this
     */
    public function setLoadRedPacket($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadRedPacket::class);
        $this->loadRedPacket = $var;

        return $this;
    }

}

