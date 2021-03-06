<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadRedPacket</code>
 */
class LoadRedPacket extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 RedPacketPrice = 1;</code>
     */
    private $RedPacketPrice = 0;
    /**
     * Generated from protobuf field <code>string RedPacketMessage = 2;</code>
     */
    private $RedPacketMessage = '';
    /**
     * Generated from protobuf field <code>int32 RedPacketNumber = 3;</code>
     */
    private $RedPacketNumber = 0;
    /**
     * Generated from protobuf field <code>int32 ChannelId = 4;</code>
     */
    private $ChannelId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 RedPacketPrice = 1;</code>
     * @return int
     */
    public function getRedPacketPrice()
    {
        return $this->RedPacketPrice;
    }

    /**
     * Generated from protobuf field <code>int32 RedPacketPrice = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRedPacketPrice($var)
    {
        GPBUtil::checkInt32($var);
        $this->RedPacketPrice = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string RedPacketMessage = 2;</code>
     * @return string
     */
    public function getRedPacketMessage()
    {
        return $this->RedPacketMessage;
    }

    /**
     * Generated from protobuf field <code>string RedPacketMessage = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRedPacketMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->RedPacketMessage = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 RedPacketNumber = 3;</code>
     * @return int
     */
    public function getRedPacketNumber()
    {
        return $this->RedPacketNumber;
    }

    /**
     * Generated from protobuf field <code>int32 RedPacketNumber = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setRedPacketNumber($var)
    {
        GPBUtil::checkInt32($var);
        $this->RedPacketNumber = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ChannelId = 4;</code>
     * @return int
     */
    public function getChannelId()
    {
        return $this->ChannelId;
    }

    /**
     * Generated from protobuf field <code>int32 ChannelId = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setChannelId($var)
    {
        GPBUtil::checkInt32($var);
        $this->ChannelId = $var;

        return $this;
    }

}

