<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RankdataListProto</code>
 */
class RankdataListProto extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RankDataProto RankDataProtoList = 1;</code>
     */
    private $RankDataProtoList;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RankDataProto RankDataProtoList = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRankDataProtoList()
    {
        return $this->RankDataProtoList;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.RankDataProto RankDataProtoList = 1;</code>
     * @param \AutoMsg\RankDataProto[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRankDataProtoList($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\RankDataProto::class);
        $this->RankDataProtoList = $arr;

        return $this;
    }

}

