<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TCDepartmentFinanceResult</code>
 */
class TCDepartmentFinanceResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     */
    private $FinanceInfo = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     * @return \AutoMsg\FinanceInfo
     */
    public function getFinanceInfo()
    {
        return $this->FinanceInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     * @param \AutoMsg\FinanceInfo $var
     * @return $this
     */
    public function setFinanceInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\FinanceInfo::class);
        $this->FinanceInfo = $var;

        return $this;
    }

}
