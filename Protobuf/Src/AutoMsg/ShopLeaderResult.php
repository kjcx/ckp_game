<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ShopLeaderResult</code>
 */
class ShopLeaderResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string FriendId = 1;</code>
     */
    private $FriendId = '';
    /**
     * Generated from protobuf field <code>string BuildId = 2;</code>
     */
    private $BuildId = '';
    /**
     * Generated from protobuf field <code>int32 StartTime = 3;</code>
     */
    private $StartTime = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string FriendId = 1;</code>
     * @return string
     */
    public function getFriendId()
    {
        return $this->FriendId;
    }

    /**
     * Generated from protobuf field <code>string FriendId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFriendId($var)
    {
        GPBUtil::checkString($var, True);
        $this->FriendId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string BuildId = 2;</code>
     * @return string
     */
    public function getBuildId()
    {
        return $this->BuildId;
    }

    /**
     * Generated from protobuf field <code>string BuildId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setBuildId($var)
    {
        GPBUtil::checkString($var, True);
        $this->BuildId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 StartTime = 3;</code>
     * @return int
     */
    public function getStartTime()
    {
        return $this->StartTime;
    }

    /**
     * Generated from protobuf field <code>int32 StartTime = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setStartTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->StartTime = $var;

        return $this;
    }

}

