<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ChatMsgFromChannelResult</code>
 */
class ChatMsgFromChannelResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Msg = 1;</code>
     */
    private $Msg = '';
    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>string ChannelId = 3;</code>
     */
    private $ChannelId = '';
    /**
     * Generated from protobuf field <code>string Name = 4;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>int32 Time = 5;</code>
     */
    private $Time = 0;
    /**
     * Generated from protobuf field <code>string Icon = 6;</code>
     */
    private $Icon = '';

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
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
     * Generated from protobuf field <code>string RoleId = 2;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
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
     * Generated from protobuf field <code>string ChannelId = 3;</code>
     * @return string
     */
    public function getChannelId()
    {
        return $this->ChannelId;
    }

    /**
     * Generated from protobuf field <code>string ChannelId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setChannelId($var)
    {
        GPBUtil::checkString($var, True);
        $this->ChannelId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Name = 4;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 4;</code>
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
     * Generated from protobuf field <code>int32 Time = 5;</code>
     * @return int
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * Generated from protobuf field <code>int32 Time = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->Time = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Icon = 6;</code>
     * @return string
     */
    public function getIcon()
    {
        return $this->Icon;
    }

    /**
     * Generated from protobuf field <code>string Icon = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setIcon($var)
    {
        GPBUtil::checkString($var, True);
        $this->Icon = $var;

        return $this;
    }

}

