<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoomVisitResult</code>
 */
class RoomVisitResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 1;</code>
     */
    private $Room = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.RoleVisitInfo Role = 2;</code>
     */
    private $Role = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 1;</code>
     * @return \AutoMsg\RoomResult
     */
    public function getRoom()
    {
        return $this->Room;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoomResult Room = 1;</code>
     * @param \AutoMsg\RoomResult $var
     * @return $this
     */
    public function setRoom($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\RoomResult::class);
        $this->Room = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoleVisitInfo Role = 2;</code>
     * @return \AutoMsg\RoleVisitInfo
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.RoleVisitInfo Role = 2;</code>
     * @param \AutoMsg\RoleVisitInfo $var
     * @return $this
     */
    public function setRole($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\RoleVisitInfo::class);
        $this->Role = $var;

        return $this;
    }

}

