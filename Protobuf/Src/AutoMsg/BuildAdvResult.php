<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.BuildAdvResult</code>
 */
class BuildAdvResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 AdvCount = 1;</code>
     */
    private $AdvCount = 0;
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.BuildAdvAffect BuildingIds = 2;</code>
     */
    private $BuildingIds;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 AdvCount = 1;</code>
     * @return int
     */
    public function getAdvCount()
    {
        return $this->AdvCount;
    }

    /**
     * Generated from protobuf field <code>int32 AdvCount = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setAdvCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->AdvCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.BuildAdvAffect BuildingIds = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getBuildingIds()
    {
        return $this->BuildingIds;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.BuildAdvAffect BuildingIds = 2;</code>
     * @param \AutoMsg\BuildAdvAffect[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setBuildingIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\BuildAdvAffect::class);
        $this->BuildingIds = $arr;

        return $this;
    }

}

