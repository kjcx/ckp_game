<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *npc状态
 *
 * Generated from protobuf message <code>AutoMsg.NpcInfo</code>
 */
class NpcInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 NpcId = 1;</code>
     */
    private $NpcId = 0;
    /**
     * Generated from protobuf field <code>bool Status = 2;</code>
     */
    private $Status = false;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 1;</code>
     * @return int
     */
    public function getNpcId()
    {
        return $this->NpcId;
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setNpcId($var)
    {
        GPBUtil::checkInt32($var);
        $this->NpcId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Status = 2;</code>
     * @return bool
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>bool Status = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkBool($var);
        $this->Status = $var;

        return $this;
    }

}
