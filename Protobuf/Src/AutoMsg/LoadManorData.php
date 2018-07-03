<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadManorData</code>
 */
class LoadManorData extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int64 PlantDate = 2;</code>
     */
    private $PlantDate = 0;
    /**
     * Generated from protobuf field <code>int32 SemenId = 3;</code>
     */
    private $SemenId = 0;
    /**
     * Generated from protobuf field <code>float StatusTime = 4;</code>
     */
    private $StatusTime = 0.0;
    /**
     * Generated from protobuf field <code>int32 Status = 5;</code>
     */
    private $Status = 0;
    /**
     * Generated from protobuf field <code>int32 PhasesStatus = 6;</code>
     */
    private $PhasesStatus = 0;
    /**
     * Generated from protobuf field <code>int32 StealTime = 7;</code>
     */
    private $StealTime = 0;
    /**
     * Generated from protobuf field <code>int32 SoilState = 8;</code>
     */
    private $SoilState = 0;
    /**
     * Generated from protobuf field <code>string UserName = 9;</code>
     */
    private $UserName = '';
    /**
     * Generated from protobuf field <code>int32 SoilLevel = 10;</code>
     */
    private $SoilLevel = 0;
    /**
     * Generated from protobuf field <code>int32 Compost = 11;</code>
     */
    private $Compost = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
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
     * Generated from protobuf field <code>int64 PlantDate = 2;</code>
     * @return int|string
     */
    public function getPlantDate()
    {
        return $this->PlantDate;
    }

    /**
     * Generated from protobuf field <code>int64 PlantDate = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setPlantDate($var)
    {
        GPBUtil::checkInt64($var);
        $this->PlantDate = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SemenId = 3;</code>
     * @return int
     */
    public function getSemenId()
    {
        return $this->SemenId;
    }

    /**
     * Generated from protobuf field <code>int32 SemenId = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setSemenId($var)
    {
        GPBUtil::checkInt32($var);
        $this->SemenId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>float StatusTime = 4;</code>
     * @return float
     */
    public function getStatusTime()
    {
        return $this->StatusTime;
    }

    /**
     * Generated from protobuf field <code>float StatusTime = 4;</code>
     * @param float $var
     * @return $this
     */
    public function setStatusTime($var)
    {
        GPBUtil::checkFloat($var);
        $this->StatusTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Status = 5;</code>
     * @return int
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>int32 Status = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkInt32($var);
        $this->Status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 PhasesStatus = 6;</code>
     * @return int
     */
    public function getPhasesStatus()
    {
        return $this->PhasesStatus;
    }

    /**
     * Generated from protobuf field <code>int32 PhasesStatus = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setPhasesStatus($var)
    {
        GPBUtil::checkInt32($var);
        $this->PhasesStatus = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 StealTime = 7;</code>
     * @return int
     */
    public function getStealTime()
    {
        return $this->StealTime;
    }

    /**
     * Generated from protobuf field <code>int32 StealTime = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setStealTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->StealTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SoilState = 8;</code>
     * @return int
     */
    public function getSoilState()
    {
        return $this->SoilState;
    }

    /**
     * Generated from protobuf field <code>int32 SoilState = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setSoilState($var)
    {
        GPBUtil::checkInt32($var);
        $this->SoilState = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string UserName = 9;</code>
     * @return string
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * Generated from protobuf field <code>string UserName = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setUserName($var)
    {
        GPBUtil::checkString($var, True);
        $this->UserName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SoilLevel = 10;</code>
     * @return int
     */
    public function getSoilLevel()
    {
        return $this->SoilLevel;
    }

    /**
     * Generated from protobuf field <code>int32 SoilLevel = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setSoilLevel($var)
    {
        GPBUtil::checkInt32($var);
        $this->SoilLevel = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Compost = 11;</code>
     * @return int
     */
    public function getCompost()
    {
        return $this->Compost;
    }

    /**
     * Generated from protobuf field <code>int32 Compost = 11;</code>
     * @param int $var
     * @return $this
     */
    public function setCompost($var)
    {
        GPBUtil::checkInt32($var);
        $this->Compost = $var;

        return $this;
    }

}

