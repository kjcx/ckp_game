<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AchievementResult</code>
 */
class AchievementResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadAchievement Achi = 1;</code>
     */
    private $Achi = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadAchievement Achi = 1;</code>
     * @return \AutoMsg\LoadAchievement
     */
    public function getAchi()
    {
        return $this->Achi;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadAchievement Achi = 1;</code>
     * @param \AutoMsg\LoadAchievement $var
     * @return $this
     */
    public function setAchi($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadAchievement::class);
        $this->Achi = $var;

        return $this;
    }

}
