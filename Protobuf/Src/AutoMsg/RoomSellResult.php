<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoomSellResult</code>
 */
class RoomSellResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 RoomId = 1;</code>
     */
    private $RoomId = 0;
    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 2;</code>
     */
    private $Room = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 RoomId = 1;</code>
     * @return int
     */
    public function getRoomId()
    {
        return $this->RoomId;
    }

    /**
     * Generated from protobuf field <code>int32 RoomId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRoomId($var)
    {
        GPBUtil::checkInt32($var);
        $this->RoomId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 2;</code>
     * @return \AutoMsg\RoomResult
     */
    public function getRoom()
    {
        return $this->Room;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 2;</code>
     * @param \AutoMsg\RoomResult $var
     * @return $this
     */
    public function setRoom($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\RoomResult::class);
        $this->Room = $var;

        return $this;
    }

}

