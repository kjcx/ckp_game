<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadSignInfoList</code>
 */
class LoadSignInfoList extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadSignInfo LoadSignList = 1;</code>
     */
    private $LoadSignList;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadSignInfo LoadSignList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLoadSignList()
    {
        return $this->LoadSignList;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadSignInfo LoadSignList = 1;</code>
     * @param \AutoMsg\LoadSignInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLoadSignList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadSignInfo::class);
        $this->LoadSignList = $arr;

        return $this;
    }

}
