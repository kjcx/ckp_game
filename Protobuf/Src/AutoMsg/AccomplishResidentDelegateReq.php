<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *修改
 *
 * Generated from protobuf message <code>AutoMsg.AccomplishResidentDelegateReq</code>
 */
class AccomplishResidentDelegateReq extends \Google\Protobuf\Internal\Message
{
    /**
     *位置id
     *
     * Generated from protobuf field <code>int32 Spot = 1;</code>
     */
    private $Spot = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *位置id
     *
     * Generated from protobuf field <code>int32 Spot = 1;</code>
     * @return int
     */
    public function getSpot()
    {
        return $this->Spot;
    }

    /**
     *位置id
     *
     * Generated from protobuf field <code>int32 Spot = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setSpot($var)
    {
        GPBUtil::checkInt32($var);
        $this->Spot = $var;

        return $this;
    }

}

