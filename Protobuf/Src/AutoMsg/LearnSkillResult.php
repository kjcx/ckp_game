<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LearnSkillResult</code>
 */
class LearnSkillResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 SkillId = 1;</code>
     */
    private $SkillId = 0;
    /**
     * Generated from protobuf field <code>int32 SkillLv = 2;</code>
     */
    private $SkillLv = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 SkillId = 1;</code>
     * @return int
     */
    public function getSkillId()
    {
        return $this->SkillId;
    }

    /**
     * Generated from protobuf field <code>int32 SkillId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setSkillId($var)
    {
        GPBUtil::checkInt32($var);
        $this->SkillId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SkillLv = 2;</code>
     * @return int
     */
    public function getSkillLv()
    {
        return $this->SkillLv;
    }

    /**
     * Generated from protobuf field <code>int32 SkillLv = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setSkillLv($var)
    {
        GPBUtil::checkInt32($var);
        $this->SkillLv = $var;

        return $this;
    }

}

