<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.HarvestPlanResult</code>
 */
class HarvestPlanResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadListId LoadHarvestCount = 1;</code>
     */
    private $LoadHarvestCount;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadListId LoadHarvestCount = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLoadHarvestCount()
    {
        return $this->LoadHarvestCount;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadListId LoadHarvestCount = 1;</code>
     * @param \AutoMsg\LoadListId[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLoadHarvestCount($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadListId::class);
        $this->LoadHarvestCount = $arr;

        return $this;
    }

}

