<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.MissionFirstCompleteResult</code>
 */
class MissionFirstCompleteResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 MissionId = 1;</code>
     */
    private $MissionId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 MissionId = 1;</code>
     * @return int
     */
    public function getMissionId()
    {
        return $this->MissionId;
    }

    /**
     * Generated from protobuf field <code>int32 MissionId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setMissionId($var)
    {
        GPBUtil::checkInt32($var);
        $this->MissionId = $var;

        return $this;
    }

}

