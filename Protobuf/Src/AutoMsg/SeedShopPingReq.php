<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.SeedShopPingReq</code>
 */
class SeedShopPingReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     */
    private $ItemId = 0;
    /**
     * Generated from protobuf field <code>int32 ItemCount = 2;</code>
     */
    private $ItemCount = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     * @return int
     */
    public function getItemId()
    {
        return $this->ItemId;
    }

    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setItemId($var)
    {
        GPBUtil::checkInt32($var);
        $this->ItemId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ItemCount = 2;</code>
     * @return int
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * Generated from protobuf field <code>int32 ItemCount = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setItemCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->ItemCount = $var;

        return $this;
    }

}

