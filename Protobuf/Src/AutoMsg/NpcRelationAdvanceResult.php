<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.NpcRelationAdvanceResult</code>
 */
class NpcRelationAdvanceResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityData = 1;</code>
     */
    private $NpcFavorabilityData = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityData = 1;</code>
     * @return \AutoMsg\LoadNpcFavorability
     */
    public function getNpcFavorabilityData()
    {
        return $this->NpcFavorabilityData;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityData = 1;</code>
     * @param \AutoMsg\LoadNpcFavorability $var
     * @return $this
     */
    public function setNpcFavorabilityData($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadNpcFavorability::class);
        $this->NpcFavorabilityData = $var;

        return $this;
    }

}
