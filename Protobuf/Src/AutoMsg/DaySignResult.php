<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.DaySignResult</code>
 */
class DaySignResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadSignInfo> LoaSignInfo = 1;</code>
     */
    private $LoaSignInfo;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadSignInfo> LoaSignInfo = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLoaSignInfo()
    {
        return $this->LoaSignInfo;
    }

    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadSignInfo> LoaSignInfo = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLoaSignInfo($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadSignInfo::class);
        $this->LoaSignInfo = $arr;

        return $this;
    }

}
