<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.NoBodyShopReq</code>
 */
class NoBodyShopReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Page = 1;</code>
     */
    private $Page = 0;
    /**
     * Generated from protobuf field <code>int32 ShopType = 3;</code>
     */
    private $ShopType = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Page = 1;</code>
     * @return int
     */
    public function getPage()
    {
        return $this->Page;
    }

    /**
     * Generated from protobuf field <code>int32 Page = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPage($var)
    {
        GPBUtil::checkInt32($var);
        $this->Page = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ShopType = 3;</code>
     * @return int
     */
    public function getShopType()
    {
        return $this->ShopType;
    }

    /**
     * Generated from protobuf field <code>int32 ShopType = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setShopType($var)
    {
        GPBUtil::checkInt32($var);
        $this->ShopType = $var;

        return $this;
    }

}

