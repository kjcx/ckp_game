<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *返回今日竞拍信息
 *
 * Generated from protobuf message <code>AutoMsg.GetAuctionLandResult</code>
 */
class GetAuctionLandResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo AuctionLandList = 1;</code>
     */
    private $AuctionLandList;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo AuctionLandList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAuctionLandList()
    {
        return $this->AuctionLandList;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.AuctionLandInfo AuctionLandList = 1;</code>
     * @param \AutoMsg\AuctionLandInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAuctionLandList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\AuctionLandInfo::class);
        $this->AuctionLandList = $arr;

        return $this;
    }

}

