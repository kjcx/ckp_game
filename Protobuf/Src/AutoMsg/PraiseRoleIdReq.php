<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.PraiseRoleIdReq</code>
 */
class PraiseRoleIdReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>int32 RolePraiseType = 2;</code>
     */
    private $RolePraiseType = 0;

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
     * Generated from protobuf field <code>int32 RolePraiseType = 2;</code>
     * @return int
     */
    public function getRolePraiseType()
    {
        return $this->RolePraiseType;
    }

    /**
     * Generated from protobuf field <code>int32 RolePraiseType = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setRolePraiseType($var)
    {
        GPBUtil::checkInt32($var);
        $this->RolePraiseType = $var;

        return $this;
    }

}

