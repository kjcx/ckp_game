<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.CultivateEmployeeReq</code>
 */
class CultivateEmployeeReq extends \Google\Protobuf\Internal\Message
{
    /**
     *原int32 改成string
     *
     * Generated from protobuf field <code>repeated string ListId = 1;</code>
     */
    private $ListId;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *原int32 改成string
     *
     * Generated from protobuf field <code>repeated string ListId = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getListId()
    {
        return $this->ListId;
    }

    /**
     *原int32 改成string
     *
     * Generated from protobuf field <code>repeated string ListId = 1;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setListId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->ListId = $arr;

        return $this;
    }

}

