<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RankingResult</code>
 */
class RankingResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRanking LoadRanking = 1;</code>
     */
    private $LoadRanking = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRanking LoadRanking = 1;</code>
     * @return \AutoMsg\LoadRanking
     */
    public function getLoadRanking()
    {
        return $this->LoadRanking;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRanking LoadRanking = 1;</code>
     * @param \AutoMsg\LoadRanking $var
     * @return $this
     */
    public function setLoadRanking($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadRanking::class);
        $this->LoadRanking = $var;

        return $this;
    }

}
