<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AppointManagerReq</code>
 */
class AppointManagerReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int32 Index = 2;</code>
     */
    private $Index = 0;
    /**
     * Generated from protobuf field <code>int32 DepartmentType = 3;</code>
     */
    private $DepartmentType = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt32($var);
        $this->Id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Index = 2;</code>
     * @return int
     */
    public function getIndex()
    {
        return $this->Index;
    }

    /**
     * Generated from protobuf field <code>int32 Index = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setIndex($var)
    {
        GPBUtil::checkInt32($var);
        $this->Index = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 DepartmentType = 3;</code>
     * @return int
     */
    public function getDepartmentType()
    {
        return $this->DepartmentType;
    }

    /**
     * Generated from protobuf field <code>int32 DepartmentType = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setDepartmentType($var)
    {
        GPBUtil::checkInt32($var);
        $this->DepartmentType = $var;

        return $this;
    }

}

