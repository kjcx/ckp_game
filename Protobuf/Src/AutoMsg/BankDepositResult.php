<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *银行取款返回 2004
 *
 * Generated from protobuf message <code>AutoMsg.BankDepositResult</code>
 */
class BankDepositResult extends \Google\Protobuf\Internal\Message
{
    /**
     *取款记录id
     *
     * Generated from protobuf field <code>int64 Id = 1;</code>
     */
    private $Id = 0;
    /**
     *1成功0失败
     *
     * Generated from protobuf field <code>int64 Status = 2;</code>
     */
    private $Status = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *取款记录id
     *
     * Generated from protobuf field <code>int64 Id = 1;</code>
     * @return int|string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     *取款记录id
     *
     * Generated from protobuf field <code>int64 Id = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt64($var);
        $this->Id = $var;

        return $this;
    }

    /**
     *1成功0失败
     *
     * Generated from protobuf field <code>int64 Status = 2;</code>
     * @return int|string
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     *1成功0失败
     *
     * Generated from protobuf field <code>int64 Status = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkInt64($var);
        $this->Status = $var;

        return $this;
    }

}
