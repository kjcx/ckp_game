<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.MissionCompleteResult</code>
 */
class MissionCompleteResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.MissionDataResult Mission = 1;</code>
     */
    private $Mission = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.MissionDataResult Mission = 1;</code>
     * @return \AutoMsg\MissionDataResult
     */
    public function getMission()
    {
        return $this->Mission;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.MissionDataResult Mission = 1;</code>
     * @param \AutoMsg\MissionDataResult $var
     * @return $this
     */
    public function setMission($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\MissionDataResult::class);
        $this->Mission = $var;

        return $this;
    }

}

