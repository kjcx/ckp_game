<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AddFurnResult</code>
 */
class AddFurnResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadRoleBagInfo Items = 1;</code>
     */
    private $Items;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadRoleBagInfo Items = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getItems()
    {
        return $this->Items;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadRoleBagInfo Items = 1;</code>
     * @param \AutoMsg\LoadRoleBagInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setItems($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadRoleBagInfo::class);
        $this->Items = $arr;

        return $this;
    }

}
