<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadAchievement</code>
 */
class LoadAchievement extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, bool> Gets = 1;</code>
     */
    private $Gets;
    /**
     * Generated from protobuf field <code>map<int32, bool> Rewards = 2;</code>
     */
    private $Rewards;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, bool> Gets = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getGets()
    {
        return $this->Gets;
    }

    /**
     * Generated from protobuf field <code>map<int32, bool> Gets = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setGets($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::BOOL);
        $this->Gets = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<int32, bool> Rewards = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getRewards()
    {
        return $this->Rewards;
    }

    /**
     * Generated from protobuf field <code>map<int32, bool> Rewards = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setRewards($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::BOOL);
        $this->Rewards = $arr;

        return $this;
    }

}

