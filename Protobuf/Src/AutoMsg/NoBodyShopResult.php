<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.NoBodyShopResult</code>
 */
class NoBodyShopResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop NoBodyShop = 1;</code>
     */
    private $NoBodyShop;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop NoBodyShop = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNoBodyShop()
    {
        return $this->NoBodyShop;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop NoBodyShop = 1;</code>
     * @param \AutoMsg\PublicShop[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNoBodyShop($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\PublicShop::class);
        $this->NoBodyShop = $arr;

        return $this;
    }

}
