<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AddNpcRelationAdvanceResult</code>
 */
class AddNpcRelationAdvanceResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityFData = 1;</code>
     */
    private $NpcFavorabilityFData = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityFData = 1;</code>
     * @return \AutoMsg\LoadNpcFavorability
     */
    public function getNpcFavorabilityFData()
    {
        return $this->NpcFavorabilityFData;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadNpcFavorability NpcFavorabilityFData = 1;</code>
     * @param \AutoMsg\LoadNpcFavorability $var
     * @return $this
     */
    public function setNpcFavorabilityFData($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadNpcFavorability::class);
        $this->NpcFavorabilityFData = $var;

        return $this;
    }

}

