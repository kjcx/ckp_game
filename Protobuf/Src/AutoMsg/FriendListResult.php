<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.FriendListResult</code>
 */
class FriendListResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Friends = 1;</code>
     */
    private $Friends;
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Blacks = 3;</code>
     */
    private $Blacks;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Friends = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getFriends()
    {
        return $this->Friends;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Friends = 1;</code>
     * @param \AutoMsg\FriendInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setFriends($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\FriendInfo::class);
        $this->Friends = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Blacks = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getBlacks()
    {
        return $this->Blacks;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.FriendInfo Blacks = 3;</code>
     * @param \AutoMsg\FriendInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setBlacks($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\FriendInfo::class);
        $this->Blacks = $arr;

        return $this;
    }

}

