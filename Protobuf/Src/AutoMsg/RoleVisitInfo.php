<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoleVisitInfo</code>
 */
class RoleVisitInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     */
    private $RoleId = '';
    /**
     * Generated from protobuf field <code>string Icon = 2;</code>
     */
    private $Icon = '';
    /**
     * Generated from protobuf field <code>string Name = 3;</code>
     */
    private $Name = '';
    /**
     * Generated from protobuf field <code>int32 Sex = 4;</code>
     */
    private $Sex = 0;
    /**
     * Generated from protobuf field <code>string VipLevel = 5;</code>
     */
    private $VipLevel = '';
    /**
     * Generated from protobuf field <code>int64 SocialStatus = 6;</code>
     */
    private $SocialStatus = 0;
    /**
     * Generated from protobuf field <code>repeated int32 Avatar = 7;</code>
     */
    private $Avatar;
    /**
     * Generated from protobuf field <code>int64 RoomPraiseTime = 8;</code>
     */
    private $RoomPraiseTime = 0;
    /**
     * Generated from protobuf field <code>int32 Achieve = 9;</code>
     */
    private $Achieve = 0;
    /**
     * Generated from protobuf field <code>int32 VipId = 10;</code>
     */
    private $VipId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRoleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->RoleId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Icon = 2;</code>
     * @return string
     */
    public function getIcon()
    {
        return $this->Icon;
    }

    /**
     * Generated from protobuf field <code>string Icon = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setIcon($var)
    {
        GPBUtil::checkString($var, True);
        $this->Icon = $var;

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
     * Generated from protobuf field <code>int32 Sex = 4;</code>
     * @return int
     */
    public function getSex()
    {
        return $this->Sex;
    }

    /**
     * Generated from protobuf field <code>int32 Sex = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setSex($var)
    {
        GPBUtil::checkInt32($var);
        $this->Sex = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string VipLevel = 5;</code>
     * @return string
     */
    public function getVipLevel()
    {
        return $this->VipLevel;
    }

    /**
     * Generated from protobuf field <code>string VipLevel = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setVipLevel($var)
    {
        GPBUtil::checkString($var, True);
        $this->VipLevel = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 SocialStatus = 6;</code>
     * @return int|string
     */
    public function getSocialStatus()
    {
        return $this->SocialStatus;
    }

    /**
     * Generated from protobuf field <code>int64 SocialStatus = 6;</code>
     * @param int|string $var
     * @return $this
     */
    public function setSocialStatus($var)
    {
        GPBUtil::checkInt64($var);
        $this->SocialStatus = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated int32 Avatar = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAvatar()
    {
        return $this->Avatar;
    }

    /**
     * Generated from protobuf field <code>repeated int32 Avatar = 7;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAvatar($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->Avatar = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 RoomPraiseTime = 8;</code>
     * @return int|string
     */
    public function getRoomPraiseTime()
    {
        return $this->RoomPraiseTime;
    }

    /**
     * Generated from protobuf field <code>int64 RoomPraiseTime = 8;</code>
     * @param int|string $var
     * @return $this
     */
    public function setRoomPraiseTime($var)
    {
        GPBUtil::checkInt64($var);
        $this->RoomPraiseTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Achieve = 9;</code>
     * @return int
     */
    public function getAchieve()
    {
        return $this->Achieve;
    }

    /**
     * Generated from protobuf field <code>int32 Achieve = 9;</code>
     * @param int $var
     * @return $this
     */
    public function setAchieve($var)
    {
        GPBUtil::checkInt32($var);
        $this->Achieve = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 VipId = 10;</code>
     * @return int
     */
    public function getVipId()
    {
        return $this->VipId;
    }

    /**
     * Generated from protobuf field <code>int32 VipId = 10;</code>
     * @param int $var
     * @return $this
     */
    public function setVipId($var)
    {
        GPBUtil::checkInt32($var);
        $this->VipId = $var;

        return $this;
    }

}

