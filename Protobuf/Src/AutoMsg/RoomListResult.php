<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoomListResult</code>
 */
class RoomListResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RoomResult Rooms = 1;</code>
     */
    private $Rooms;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RoomResult Rooms = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRooms()
    {
        return $this->Rooms;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RoomResult Rooms = 1;</code>
     * @param \AutoMsg\RoomResult[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRooms($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\RoomResult::class);
        $this->Rooms = $arr;

        return $this;
    }

}

