<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.FurnitureStarResult</code>
 */
class FurnitureStarResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 2;</code>
     */
    private $Item;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setItem($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT64);
        $this->Item = $arr;

        return $this;
    }

}

