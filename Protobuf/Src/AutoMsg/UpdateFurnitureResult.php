<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.UpdateFurnitureResult</code>
 */
class UpdateFurnitureResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int64, .AutoMsg.LoadRoleBagInfo> Furnitures = 1;</code>
     */
    private $Furnitures;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int64, .AutoMsg.LoadRoleBagInfo> Furnitures = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getFurnitures()
    {
        return $this->Furnitures;
    }

    /**
     * Generated from protobuf field <code>map<int64, .AutoMsg.LoadRoleBagInfo> Furnitures = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setFurnitures($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT64, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadRoleBagInfo::class);
        $this->Furnitures = $arr;

        return $this;
    }

}
