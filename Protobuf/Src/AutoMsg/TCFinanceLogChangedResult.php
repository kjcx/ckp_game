<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TCFinanceLogChangedResult</code>
 */
class TCFinanceLogChangedResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadFinanceLogInfo FinanceLogInfo = 1;</code>
     */
    private $FinanceLogInfo;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadFinanceLogInfo FinanceLogInfo = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getFinanceLogInfo()
    {
        return $this->FinanceLogInfo;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadFinanceLogInfo FinanceLogInfo = 1;</code>
     * @param \AutoMsg\LoadFinanceLogInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setFinanceLogInfo($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadFinanceLogInfo::class);
        $this->FinanceLogInfo = $arr;

        return $this;
    }

}

