<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.UpdataRoleShopResult</code>
 */
class UpdataRoleShopResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.PublicShop PushPublicShop = 1;</code>
     */
    private $PushPublicShop = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.PublicShop PushPublicShop = 1;</code>
     * @return \AutoMsg\PublicShop
     */
    public function getPushPublicShop()
    {
        return $this->PushPublicShop;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.PublicShop PushPublicShop = 1;</code>
     * @param \AutoMsg\PublicShop $var
     * @return $this
     */
    public function setPushPublicShop($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\PublicShop::class);
        $this->PushPublicShop = $var;

        return $this;
    }

}

