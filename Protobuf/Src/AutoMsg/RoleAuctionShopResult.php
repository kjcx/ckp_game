<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoleAuctionShopResult</code>
 */
class RoleAuctionShopResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop RoleAuctionShop = 1;</code>
     */
    private $RoleAuctionShop;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop RoleAuctionShop = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRoleAuctionShop()
    {
        return $this->RoleAuctionShop;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.PublicShop RoleAuctionShop = 1;</code>
     * @param \AutoMsg\PublicShop[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRoleAuctionShop($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\PublicShop::class);
        $this->RoleAuctionShop = $arr;

        return $this;
    }

}

