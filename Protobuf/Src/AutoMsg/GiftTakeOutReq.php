<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.GiftTakeOutReq</code>
 */
class GiftTakeOutReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string FriendId = 1;</code>
     */
    private $FriendId = '';
    /**
     * Generated from protobuf field <code>int32 Item = 2;</code>
     */
    private $Item = 0;

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
     * Generated from protobuf field <code>int32 Item = 2;</code>
     * @return int
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * Generated from protobuf field <code>int32 Item = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setItem($var)
    {
        GPBUtil::checkInt32($var);
        $this->Item = $var;

        return $this;
    }

}

