<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TCAchievementResult</code>
 */
class TCAchievementResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Id = 1;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>bool Statuss = 2;</code>
     */
    private $Statuss = false;

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
     * Generated from protobuf field <code>bool Statuss = 2;</code>
     * @return bool
     */
    public function getStatuss()
    {
        return $this->Statuss;
    }

    /**
     * Generated from protobuf field <code>bool Statuss = 2;</code>
     * @param bool $var
     * @return $this
     */
    public function setStatuss($var)
    {
        GPBUtil::checkBool($var);
        $this->Statuss = $var;

        return $this;
    }

}
