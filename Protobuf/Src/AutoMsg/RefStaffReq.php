<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RefStaffReq</code>
 */
class RefStaffReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 TypeId = 1;</code>
     */
    private $TypeId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 TypeId = 1;</code>
     * @return int
     */
    public function getTypeId()
    {
        return $this->TypeId;
    }

    /**
     * Generated from protobuf field <code>int32 TypeId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setTypeId($var)
    {
        GPBUtil::checkInt32($var);
        $this->TypeId = $var;

        return $this;
    }

}

