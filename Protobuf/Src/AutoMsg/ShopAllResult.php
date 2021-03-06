<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ShopAllResult</code>
 */
class ShopAllResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadDropData LoadConsume = 1;</code>
     */
    private $LoadConsume;
    /**
     * Generated from protobuf field <code>int32 Time = 2;</code>
     */
    private $Time = 0;
    /**
     * Generated from protobuf field <code>int32 Date = 3;</code>
     */
    private $Date = 0;
    /**
     * Generated from protobuf field <code>int32 MenSWearTime = 4;</code>
     */
    private $MenSWearTime = 0;
    /**
     * Generated from protobuf field <code>int32 WoMenSWearTime = 5;</code>
     */
    private $WoMenSWearTime = 0;
    /**
     * Generated from protobuf field <code>int32 HairdressingTime = 6;</code>
     */
    private $HairdressingTime = 0;
    /**
     * Generated from protobuf field <code>int32 OrnamentTime = 7;</code>
     */
    private $OrnamentTime = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadDropData LoadConsume = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLoadConsume()
    {
        return $this->LoadConsume;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadDropData LoadConsume = 1;</code>
     * @param \AutoMsg\LoadDropData[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLoadConsume($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadDropData::class);
        $this->LoadConsume = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Time = 2;</code>
     * @return int
     */
    public function getTime()
    {
        return $this->Time;
    }

    /**
     * Generated from protobuf field <code>int32 Time = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->Time = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Date = 3;</code>
     * @return int
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * Generated from protobuf field <code>int32 Date = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setDate($var)
    {
        GPBUtil::checkInt32($var);
        $this->Date = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 MenSWearTime = 4;</code>
     * @return int
     */
    public function getMenSWearTime()
    {
        return $this->MenSWearTime;
    }

    /**
     * Generated from protobuf field <code>int32 MenSWearTime = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setMenSWearTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->MenSWearTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 WoMenSWearTime = 5;</code>
     * @return int
     */
    public function getWoMenSWearTime()
    {
        return $this->WoMenSWearTime;
    }

    /**
     * Generated from protobuf field <code>int32 WoMenSWearTime = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setWoMenSWearTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->WoMenSWearTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 HairdressingTime = 6;</code>
     * @return int
     */
    public function getHairdressingTime()
    {
        return $this->HairdressingTime;
    }

    /**
     * Generated from protobuf field <code>int32 HairdressingTime = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setHairdressingTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->HairdressingTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 OrnamentTime = 7;</code>
     * @return int
     */
    public function getOrnamentTime()
    {
        return $this->OrnamentTime;
    }

    /**
     * Generated from protobuf field <code>int32 OrnamentTime = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setOrnamentTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->OrnamentTime = $var;

        return $this;
    }

}

