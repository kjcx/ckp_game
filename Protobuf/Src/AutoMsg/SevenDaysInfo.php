<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.SevenDaysInfo</code>
 */
class SevenDaysInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>bool IsPickUp = 2;</code>
     */
    private $IsPickUp = false;
    /**
     * Generated from protobuf field <code>bool IsLogin = 3;</code>
     */
    private $IsLogin = false;

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
     * Generated from protobuf field <code>bool IsPickUp = 2;</code>
     * @return bool
     */
    public function getIsPickUp()
    {
        return $this->IsPickUp;
    }

    /**
     * Generated from protobuf field <code>bool IsPickUp = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsPickUp($var)
    {
        GPBUtil::checkBool($var);
        $this->IsPickUp = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool IsLogin = 3;</code>
     * @return bool
     */
    public function getIsLogin()
    {
        return $this->IsLogin;
    }

    /**
     * Generated from protobuf field <code>bool IsLogin = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsLogin($var)
    {
        GPBUtil::checkBool($var);
        $this->IsLogin = $var;

        return $this;
    }

}

