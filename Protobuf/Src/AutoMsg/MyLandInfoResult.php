<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *已获得土地信息
 *
 * Generated from protobuf message <code>AutoMsg.MyLandInfoResult</code>
 */
class MyLandInfoResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo MyLandInfoList = 1;</code>
     */
    private $MyLandInfoList;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo MyLandInfoList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMyLandInfoList()
    {
        return $this->MyLandInfoList;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo MyLandInfoList = 1;</code>
     * @param \AutoMsg\AuctionLandInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMyLandInfoList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\AuctionLandInfo::class);
        $this->MyLandInfoList = $arr;

        return $this;
    }

}

