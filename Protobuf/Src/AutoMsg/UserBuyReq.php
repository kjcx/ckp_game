<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *购买请求
 *
 * Generated from protobuf message <code>AutoMsg.UserBuyReq</code>
 */
class UserBuyReq extends \Google\Protobuf\Internal\Message
{
    /**
     *记录id
     *
     * Generated from protobuf field <code>string Id = 1;</code>
     */
    private $Id = '';
    /**
     *数量
     *
     * Generated from protobuf field <code>int32 Count = 2;</code>
     */
    private $Count = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *记录id
     *
     * Generated from protobuf field <code>string Id = 1;</code>
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     *记录id
     *
     * Generated from protobuf field <code>string Id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->Id = $var;

        return $this;
    }

    /**
     *数量
     *
     * Generated from protobuf field <code>int32 Count = 2;</code>
     * @return int
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     *数量
     *
     * Generated from protobuf field <code>int32 Count = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->Count = $var;

        return $this;
    }

}

