<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TalkingGroupPKResult</code>
 */
class TalkingGroupPKResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Winer = 1;</code>
     */
    private $Winer = '';
    /**
     * Generated from protobuf field <code>int32 NpcId = 2;</code>
     */
    private $NpcId = 0;
    /**
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamA = 3;</code>
     */
    private $TeamA = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamB = 4;</code>
     */
    private $TeamB = null;
    /**
     * Generated from protobuf field <code>int32 PKCount = 5;</code>
     */
    private $PKCount = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string Winer = 1;</code>
     * @return string
     */
    public function getWiner()
    {
        return $this->Winer;
    }

    /**
     * Generated from protobuf field <code>string Winer = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setWiner($var)
    {
        GPBUtil::checkString($var, True);
        $this->Winer = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 2;</code>
     * @return int
     */
    public function getNpcId()
    {
        return $this->NpcId;
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 2;</code>
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
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamA = 3;</code>
     * @return \AutoMsg\TalkingGroupTeam
     */
    public function getTeamA()
    {
        return $this->TeamA;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamA = 3;</code>
     * @param \AutoMsg\TalkingGroupTeam $var
     * @return $this
     */
    public function setTeamA($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\TalkingGroupTeam::class);
        $this->TeamA = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamB = 4;</code>
     * @return \AutoMsg\TalkingGroupTeam
     */
    public function getTeamB()
    {
        return $this->TeamB;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.TalkingGroupTeam TeamB = 4;</code>
     * @param \AutoMsg\TalkingGroupTeam $var
     * @return $this
     */
    public function setTeamB($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\TalkingGroupTeam::class);
        $this->TeamB = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 PKCount = 5;</code>
     * @return int
     */
    public function getPKCount()
    {
        return $this->PKCount;
    }

    /**
     * Generated from protobuf field <code>int32 PKCount = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setPKCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->PKCount = $var;

        return $this;
    }

}

