<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AKeyMatureReq</code>
 */
class AKeyMatureReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int64 Money = 2;</code>
     */
    private $Money = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt32($var);
        $this->Id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 Money = 2;</code>
     * @return int|string
     */
    public function getMoney()
    {
        return $this->Money;
    }

    /**
     * Generated from protobuf field <code>int64 Money = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setMoney($var)
    {
        GPBUtil::checkInt64($var);
        $this->Money = $var;

        return $this;
    }

}

