<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadUserAttr</code>
 */
class LoadUserAttr extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 UserAttrID = 1;</code>
     */
    private $UserAttrID = 0;
    /**
     * Generated from protobuf field <code>int32 Count = 2;</code>
     */
    private $Count = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 UserAttrID = 1;</code>
     * @return int
     */
    public function getUserAttrID()
    {
        return $this->UserAttrID;
    }

    /**
     * Generated from protobuf field <code>int32 UserAttrID = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setUserAttrID($var)
    {
        GPBUtil::checkInt32($var);
        $this->UserAttrID = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Count = 2;</code>
     * @return int
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * Generated from protobuf field <code>int32 Count = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->Count = $var;

        return $this;
    }

}

