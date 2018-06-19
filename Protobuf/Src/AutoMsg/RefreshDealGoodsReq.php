<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RefreshDealGoodsReq</code>
 */
class RefreshDealGoodsReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Page = 1;</code>
     */
    private $Page = 0;
    /**
     * Generated from protobuf field <code>string Keyword = 2;</code>
     */
    private $Keyword = '';
    /**
     * Generated from protobuf field <code>int32 GoodsType = 3;</code>
     */
    private $GoodsType = 0;
    /**
     * Generated from protobuf field <code>int32 DealType = 4;</code>
     */
    private $DealType = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
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
     * Generated from protobuf field <code>string Keyword = 2;</code>
     * @return string
     */
    public function getKeyword()
    {
        return $this->Keyword;
    }

    /**
     * Generated from protobuf field <code>string Keyword = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setKeyword($var)
    {
        GPBUtil::checkString($var, True);
        $this->Keyword = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 GoodsType = 3;</code>
     * @return int
     */
    public function getGoodsType()
    {
        return $this->GoodsType;
    }

    /**
     * Generated from protobuf field <code>int32 GoodsType = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setGoodsType($var)
    {
        GPBUtil::checkInt32($var);
        $this->GoodsType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 DealType = 4;</code>
     * @return int
     */
    public function getDealType()
    {
        return $this->DealType;
    }

    /**
     * Generated from protobuf field <code>int32 DealType = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setDealType($var)
    {
        GPBUtil::checkInt32($var);
        $this->DealType = $var;

        return $this;
    }

}

