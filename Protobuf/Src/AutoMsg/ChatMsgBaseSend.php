<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ChatMsgBaseSend</code>
 */
class ChatMsgBaseSend extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 MsgId = 1;</code>
     */
    private $MsgId = 0;
    /**
     * Generated from protobuf field <code>bytes Data = 3;</code>
     */
    private $Data = '';
    /**
     * Generated from protobuf field <code>string ErrorMsg = 4;</code>
     */
    private $ErrorMsg = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 MsgId = 1;</code>
     * @return int
     */
    public function getMsgId()
    {
        return $this->MsgId;
    }

    /**
     * Generated from protobuf field <code>int32 MsgId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setMsgId($var)
    {
        GPBUtil::checkInt32($var);
        $this->MsgId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes Data = 3;</code>
     * @return string
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * Generated from protobuf field <code>bytes Data = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setData($var)
    {
        GPBUtil::checkString($var, False);
        $this->Data = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string ErrorMsg = 4;</code>
     * @return string
     */
    public function getErrorMsg()
    {
        return $this->ErrorMsg;
    }

    /**
     * Generated from protobuf field <code>string ErrorMsg = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setErrorMsg($var)
    {
        GPBUtil::checkString($var, True);
        $this->ErrorMsg = $var;

        return $this;
    }

}

