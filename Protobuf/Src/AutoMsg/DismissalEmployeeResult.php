<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.DismissalEmployeeResult</code>
 */
class DismissalEmployeeResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated string ListId = 1;</code>
     */
    private $ListId;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated string ListId = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getListId()
    {
        return $this->ListId;
    }

    /**
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

