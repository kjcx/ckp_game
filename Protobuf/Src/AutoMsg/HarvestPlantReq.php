<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.HarvestPlantReq</code>
 */
class HarvestPlantReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated int32 HarvestPlanId = 1;</code>
     */
    private $HarvestPlanId;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated int32 HarvestPlanId = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getHarvestPlanId()
    {
        return $this->HarvestPlanId;
    }

    /**
     * Generated from protobuf field <code>repeated int32 HarvestPlanId = 1;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setHarvestPlanId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->HarvestPlanId = $arr;

        return $this;
    }

}

