<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.GiftTakeLogsResult</code>
 */
class GiftTakeLogsResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated int32 TakeGiftList = 1;</code>
     */
    private $TakeGiftList;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated int32 TakeGiftList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTakeGiftList()
    {
        return $this->TakeGiftList;
    }

    /**
     * Generated from protobuf field <code>repeated int32 TakeGiftList = 1;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTakeGiftList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->TakeGiftList = $arr;

        return $this;
    }

}
