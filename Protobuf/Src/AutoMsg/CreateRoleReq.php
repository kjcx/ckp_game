<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.CreateRoleReq</code>
 */
class CreateRoleReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Name = 1;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>int32 Sex = 2;</code>
     */
    private $Sex = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string Name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 1;</code>
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
     * Generated from protobuf field <code>int32 Sex = 2;</code>
     * @return int
     */
    public function getSex()
    {
        return $this->Sex;
    }

    /**
     * Generated from protobuf field <code>int32 Sex = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setSex($var)
    {
        GPBUtil::checkInt32($var);
        $this->Sex = $var;

        return $this;
    }

}

