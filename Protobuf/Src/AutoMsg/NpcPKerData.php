<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.NpcPKerData</code>
 */
class NpcPKerData extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int32 NpcId = 2;</code>
     */
    private $NpcId = 0;
    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>int32 Win = 4;</code>
     */
    private $Win = 0;
    /**
     * Generated from protobuf field <code>int64 Fighting = 5;</code>
     */
    private $Fighting = 0;
    /**
     * Generated from protobuf field <code>int64 FightingPlus = 6;</code>
     */
    private $FightingPlus = 0;
    /**
     * Generated from protobuf field <code>int32 Level = 7;</code>
     */
    private $Level = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @return int
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt32($var);
        $this->Id = $var;

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
     * Generated from protobuf field <code>string Name = 3;</code>
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->Name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Win = 4;</code>
     * @return int
     */
    public function getWin()
    {
        return $this->Win;
    }

    /**
     * Generated from protobuf field <code>int32 Win = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setWin($var)
    {
        GPBUtil::checkInt32($var);
        $this->Win = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 Fighting = 5;</code>
     * @return int|string
     */
    public function getFighting()
    {
        return $this->Fighting;
    }

    /**
     * Generated from protobuf field <code>int64 Fighting = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setFighting($var)
    {
        GPBUtil::checkInt64($var);
        $this->Fighting = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 FightingPlus = 6;</code>
     * @return int|string
     */
    public function getFightingPlus()
    {
        return $this->FightingPlus;
    }

    /**
     * Generated from protobuf field <code>int64 FightingPlus = 6;</code>
     * @param int|string $var
     * @return $this
     */
    public function setFightingPlus($var)
    {
        GPBUtil::checkInt64($var);
        $this->FightingPlus = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 7;</code>
     * @return int
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setLevel($var)
    {
        GPBUtil::checkInt32($var);
        $this->Level = $var;

        return $this;
    }

}
