<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.HarvestPublicShopReq</code>
 */
class HarvestPublicShopReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated string ShopId = 1;</code>
     */
    private $ShopId;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated string ShopId = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getShopId()
    {
        return $this->ShopId;
    }

    /**
     * Generated from protobuf field <code>repeated string ShopId = 1;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setShopId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->ShopId = $arr;

        return $this;
    }

}

