<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.FriendInteractiveReq</code>
 */
class FriendInteractiveReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     */
    private $Type = 0;
    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
     */
    private $RoleId = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     * @return int
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * Generated from protobuf field <code>int32 Type = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkInt32($var);
        $this->Type = $var;

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

}

