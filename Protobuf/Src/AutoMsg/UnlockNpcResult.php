<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *返回解锁npc成功
 *
 * Generated from protobuf message <code>AutoMsg.UnlockNpcResult</code>
 */
class UnlockNpcResult extends \Google\Protobuf\Internal\Message
{
    /**
     *NPCId;
     *
     * Generated from protobuf field <code>int32 NpcId = 1;</code>
     */
    private $NpcId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *NPCId;
     *
     * Generated from protobuf field <code>int32 NpcId = 1;</code>
     * @return int
     */
    public function getNpcId()
    {
        return $this->NpcId;
    }

    /**
     *NPCId;
     *
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

}
