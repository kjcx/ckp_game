<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.SendMsgToChannelReq</code>
 */
class SendMsgToChannelReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Msg = 1;</code>
     */
    private $Msg = '';
    /**
     * Generated from protobuf field <code>int32 ChannelId = 2;</code>
     */
    private $ChannelId = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string Msg = 1;</code>
     * @return string
     */
    public function getMsg()
    {
        return $this->Msg;
    }

    /**
     * Generated from protobuf field <code>string Msg = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setMsg($var)
    {
        GPBUtil::checkString($var, True);
        $this->Msg = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ChannelId = 2;</code>
     * @return int
     */
    public function getChannelId()
    {
        return $this->ChannelId;
    }

    /**
     * Generated from protobuf field <code>int32 ChannelId = 2;</code>
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
