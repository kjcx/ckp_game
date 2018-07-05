<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ChatMessageInfo</code>
 */
class ChatMessageInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     */
    private $Icon = '';
    /**
     * Generated from protobuf field <code>string VIP = 4;</code>
     */
    private $VIP = '';
    /**
     * Generated from protobuf field <code>int64 OnlineTime = 5;</code>
     */
    private $OnlineTime = 0;
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ChatMessage Messages = 6;</code>
     */
    private $Messages;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRoleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->RoleId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->Name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     * @return string
     */
    public function getIcon()
    {
        return $this->Icon;
    }

    /**
     * Generated from protobuf field <code>string Icon = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setIcon($var)
    {
        GPBUtil::checkString($var, True);
        $this->Icon = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string VIP = 4;</code>
     * @return string
     */
    public function getVIP()
    {
        return $this->VIP;
    }

    /**
     * Generated from protobuf field <code>string VIP = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setVIP($var)
    {
        GPBUtil::checkString($var, True);
        $this->VIP = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 OnlineTime = 5;</code>
     * @return int|string
     */
    public function getOnlineTime()
    {
        return $this->OnlineTime;
    }

    /**
     * Generated from protobuf field <code>int64 OnlineTime = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setOnlineTime($var)
    {
        GPBUtil::checkInt64($var);
        $this->OnlineTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ChatMessage Messages = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMessages()
    {
        return $this->Messages;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ChatMessage Messages = 6;</code>
     * @param \AutoMsg\ChatMessage[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMessages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\ChatMessage::class);
        $this->Messages = $arr;

        return $this;
    }

}

