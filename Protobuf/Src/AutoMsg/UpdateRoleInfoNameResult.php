<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.UpdateRoleInfoNameResult</code>
 */
class UpdateRoleInfoNameResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleName = 1;</code>
     */
    private $RoleName = '';

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string RoleName = 1;</code>
     * @return string
     */
    public function getRoleName()
    {
        return $this->RoleName;
    }

    /**
     * Generated from protobuf field <code>string RoleName = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRoleName($var)
    {
        GPBUtil::checkString($var, True);
        $this->RoleName = $var;

        return $this;
    }

}

