<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.PickUpSevenDaysResult</code>
 */
class PickUpSevenDaysResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.SevenDaysInfo SevenDaysList = 1;</code>
     */
    private $SevenDaysList = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.SevenDaysInfo SevenDaysList = 1;</code>
     * @return \AutoMsg\SevenDaysInfo
     */
    public function getSevenDaysList()
    {
        return $this->SevenDaysList;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.SevenDaysInfo SevenDaysList = 1;</code>
     * @param \AutoMsg\SevenDaysInfo $var
     * @return $this
     */
    public function setSevenDaysList($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\SevenDaysInfo::class);
        $this->SevenDaysList = $var;

        return $this;
    }

}

