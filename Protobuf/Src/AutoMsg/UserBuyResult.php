<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *购买返回
 *
 * Generated from protobuf message <code>AutoMsg.UserBuyResult</code>
 */
class UserBuyResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.DealGoodsUpdate Goods = 1;</code>
     */
    private $Goods = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.DealGoodsUpdate Goods = 1;</code>
     * @return \AutoMsg\DealGoodsUpdate
     */
    public function getGoods()
    {
        return $this->Goods;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.DealGoodsUpdate Goods = 1;</code>
     * @param \AutoMsg\DealGoodsUpdate $var
     * @return $this
     */
    public function setGoods($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\DealGoodsUpdate::class);
        $this->Goods = $var;

        return $this;
    }

}

