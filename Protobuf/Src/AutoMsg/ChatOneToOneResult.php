<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ChatOneToOneResult</code>
 */
class ChatOneToOneResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>string MsgId = 2;</code>
     */
    private $MsgId = '';
    /**
     * Generated from protobuf field <code>string Msg = 3;</code>
     */
    private $Msg = '';
    /**
     * Generated from protobuf field <code>string Name = 4;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>string Head = 5;</code>
     */
    private $Head = '';

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
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
     * Generated from protobuf field <code>string MsgId = 2;</code>
     * @return string
     */
    public function getMsgId()
    {
        return $this->MsgId;
    }

    /**
     * Generated from protobuf field <code>string MsgId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMsgId($var)
    {
        GPBUtil::checkString($var, True);
        $this->MsgId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Msg = 3;</code>
     * @return string
     */
    public function getMsg()
    {
        return $this->Msg;
    }

    /**
     * Generated from protobuf field <code>string Msg = 3;</code>
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
     * Generated from protobuf field <code>string Head = 5;</code>
     * @return string
     */
    public function getHead()
    {
        return $this->Head;
    }

    /**
     * Generated from protobuf field <code>string Head = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setHead($var)
    {
        GPBUtil::checkString($var, True);
        $this->Head = $var;

        return $this;
    }

}

