<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.OpenPortResult</code>
 */
class OpenPortResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadTradeData> LoadTrade = 1;</code>
     */
    private $LoadTrade;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadTradeData> LoadTrade = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getLoadTrade()
    {
        return $this->LoadTrade;
    }

    /**
     * Generated from protobuf field <code>map<int32, .AutoMsg.LoadTradeData> LoadTrade = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setLoadTrade($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadTradeData::class);
        $this->LoadTrade = $arr;

        return $this;
    }

}

