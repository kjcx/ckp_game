<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *获取竞拍今日竞拍土地信息
 *
 * Generated from protobuf message <code>AutoMsg.GetAuctionLandReq</code>
 */
class GetAuctionLandReq extends \Google\Protobuf\Internal\Message
{
    /**
     *地块1
     *
     * Generated from protobuf field <code>string Zone = 1;</code>
     */
    private $Zone = '';

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *地块1
     *
     * Generated from protobuf field <code>string Zone = 1;</code>
     * @return string
     */
    public function getZone()
    {
        return $this->Zone;
    }

    /**
     *地块1
     *
     * Generated from protobuf field <code>string Zone = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setZone($var)
    {
        GPBUtil::checkString($var, True);
        $this->Zone = $var;

        return $this;
    }

}

