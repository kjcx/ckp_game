<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ScoreShopResult</code>
 */
class ScoreShopResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 RefshTime = 1;</code>
     */
    private $RefshTime = 0;
    /**
     * Generated from protobuf field <code>map<int32, int32> BuyInfo = 2;</code>
     */
    private $BuyInfo;
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ScoreShopRecordResult ScoreRecords = 3;</code>
     */
    private $ScoreRecords;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 RefshTime = 1;</code>
     * @return int
     */
    public function getRefshTime()
    {
        return $this->RefshTime;
    }

    /**
     * Generated from protobuf field <code>int32 RefshTime = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setRefshTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->RefshTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<int32, int32> BuyInfo = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getBuyInfo()
    {
        return $this->BuyInfo;
    }

    /**
     * Generated from protobuf field <code>map<int32, int32> BuyInfo = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setBuyInfo($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT32);
        $this->BuyInfo = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ScoreShopRecordResult ScoreRecords = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getScoreRecords()
    {
        return $this->ScoreRecords;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.ScoreShopRecordResult ScoreRecords = 3;</code>
     * @param \AutoMsg\ScoreShopRecordResult[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setScoreRecords($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\ScoreShopRecordResult::class);
        $this->ScoreRecords = $arr;

        return $this;
    }

}
