<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.FriendApplyResult</code>
 */
class FriendApplyResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.FriendInfo Info = 1;</code>
     */
    private $Info = null;
    /**
     * Generated from protobuf field <code>bool To = 2;</code>
     */
    private $To = false;
    /**
     * Generated from protobuf field <code>bool Applyed = 3;</code>
     */
    private $Applyed = false;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FriendInfo Info = 1;</code>
     * @return \AutoMsg\FriendInfo
     */
    public function getInfo()
    {
        return $this->Info;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FriendInfo Info = 1;</code>
     * @param \AutoMsg\FriendInfo $var
     * @return $this
     */
    public function setInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\FriendInfo::class);
        $this->Info = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool To = 2;</code>
     * @return bool
     */
    public function getTo()
    {
        return $this->To;
    }

    /**
     * Generated from protobuf field <code>bool To = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setTo($var)
    {
        GPBUtil::checkBool($var);
        $this->To = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Applyed = 3;</code>
     * @return bool
     */
    public function getApplyed()
    {
        return $this->Applyed;
    }

    /**
     * Generated from protobuf field <code>bool Applyed = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setApplyed($var)
    {
        GPBUtil::checkBool($var);
        $this->Applyed = $var;

        return $this;
    }

}

