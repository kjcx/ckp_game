<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.GetMapReq</code>
 */
class GetMapReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Zone = 1;</code>
     */
    private $Zone = '';
    /**
     * Generated from protobuf field <code>repeated int32 Pos = 2;</code>
     */
    private $Pos;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string Zone = 1;</code>
     * @return string
     */
    public function getZone()
    {
        return $this->Zone;
    }

    /**
     * Generated from protobuf field <code>string Zone = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setZone($var)
    {
        GPBUtil::checkString($var, True);
        $this->Zone = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated int32 Pos = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPos()
    {
        return $this->Pos;
    }

    /**
     * Generated from protobuf field <code>repeated int32 Pos = 2;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPos($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->Pos = $arr;

        return $this;
    }

}

