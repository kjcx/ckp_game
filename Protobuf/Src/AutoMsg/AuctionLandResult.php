<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *竞拍返回
 *
 * Generated from protobuf message <code>AutoMsg.AuctionLandResult</code>
 */
class AuctionLandResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.AuctionLandInfo AuctionLandInfo = 1;</code>
     */
    private $AuctionLandInfo = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.AuctionLandInfo AuctionLandInfo = 1;</code>
     * @return \AutoMsg\AuctionLandInfo
     */
    public function getAuctionLandInfo()
    {
        return $this->AuctionLandInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.AuctionLandInfo AuctionLandInfo = 1;</code>
     * @param \AutoMsg\AuctionLandInfo $var
     * @return $this
     */
    public function setAuctionLandInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\AuctionLandInfo::class);
        $this->AuctionLandInfo = $var;

        return $this;
    }

}

