<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadRefStaff</code>
 */
class LoadRefStaff extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int32 EmployersDate = 2;</code>
     */
    private $EmployersDate = 0;
    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>map<int32, int32> BasicProperties = 4;</code>
     */
    private $BasicProperties;
    /**
     * Generated from protobuf field <code>int32 LevelUpTime = 5;</code>
     */
    private $LevelUpTime = 0;
    /**
     * Generated from protobuf field <code>string ShopId = 6;</code>
     */
    private $ShopId = '';
    /**
     * Generated from protobuf field <code>int32 NpcId = 7;</code>
     */
    private $NpcId = 0;
    /**
     * Generated from protobuf field <code>int32 ComprehensionTime = 8;</code>
     */
    private $ComprehensionTime = 0;
    /**
     * Generated from protobuf field <code>bool Appointed = 9;</code>
     */
    private $Appointed = false;
    /**
     * Generated from protobuf field <code>int32 Pos = 10;</code>
     */
    private $Pos = 0;

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
     * Generated from protobuf field <code>int32 EmployersDate = 2;</code>
     * @return int
     */
    public function getEmployersDate()
    {
        return $this->EmployersDate;
    }

    /**
     * Generated from protobuf field <code>int32 EmployersDate = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setEmployersDate($var)
    {
        GPBUtil::checkInt32($var);
        $this->EmployersDate = $var;

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
     * Generated from protobuf field <code>map<int32, int32> BasicProperties = 4;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getBasicProperties()
    {
        return $this->BasicProperties;
    }

    /**
     * Generated from protobuf field <code>map<int32, int32> BasicProperties = 4;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setBasicProperties($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT32);
        $this->BasicProperties = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 LevelUpTime = 5;</code>
     * @return int
     */
    public function getLevelUpTime()
    {
        return $this->LevelUpTime;
    }

    /**
     * Generated from protobuf field <code>int32 LevelUpTime = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setLevelUpTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->LevelUpTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 6;</code>
     * @return string
     */
    public function getShopId()
    {
        return $this->ShopId;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setShopId($var)
    {
        GPBUtil::checkString($var, True);
        $this->ShopId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 7;</code>
     * @return int
     */
    public function getNpcId()
    {
        return $this->NpcId;
    }

    /**
     * Generated from protobuf field <code>int32 NpcId = 7;</code>
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
     * Generated from protobuf field <code>int32 ComprehensionTime = 8;</code>
     * @return int
     */
    public function getComprehensionTime()
    {
        return $this->ComprehensionTime;
    }

    /**
     * Generated from protobuf field <code>int32 ComprehensionTime = 8;</code>
     * @param int $var
     * @return $this
     */
    public function setComprehensionTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->ComprehensionTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Appointed = 9;</code>
     * @return bool
     */
    public function getAppointed()
    {
        return $this->Appointed;
    }

    /**
     * Generated from protobuf field <code>bool Appointed = 9;</code>
     * @param bool $var
     * @return $this
     */
    public function setAppointed($var)
    {
        GPBUtil::checkBool($var);
        $this->Appointed = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Pos = 10;</code>
     * @return int
     */
    public function getPos()
    {
        return $this->Pos;
    }

    /**
     * Generated from protobuf field <code>int32 Pos = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setPos($var)
    {
        GPBUtil::checkInt32($var);
        $this->Pos = $var;

        return $this;
    }

}

