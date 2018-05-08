<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadTradeData</code>
 */
class LoadTradeData extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 1;</code>
     */
    private $ItemCount;
    /**
     * Generated from protobuf field <code>int32 ShipType = 2;</code>
     */
    private $ShipType = 0;
    /**
     * Generated from protobuf field <code>repeated string FriendId = 3;</code>
     */
    private $FriendId;
    /**
     * Generated from protobuf field <code>int32 TradeDate = 4;</code>
     */
    private $TradeDate = 0;
    /**
     * Generated from protobuf field <code>int64 Money = 5;</code>
     */
    private $Money = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setItemCount($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT64);
        $this->ItemCount = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ShipType = 2;</code>
     * @return int
     */
    public function getShipType()
    {
        return $this->ShipType;
    }

    /**
     * Generated from protobuf field <code>int32 ShipType = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setShipType($var)
    {
        GPBUtil::checkInt32($var);
        $this->ShipType = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated string FriendId = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getFriendId()
    {
        return $this->FriendId;
    }

    /**
     * Generated from protobuf field <code>repeated string FriendId = 3;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setFriendId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->FriendId = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 TradeDate = 4;</code>
     * @return int
     */
    public function getTradeDate()
    {
        return $this->TradeDate;
    }

    /**
     * Generated from protobuf field <code>int32 TradeDate = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setTradeDate($var)
    {
        GPBUtil::checkInt32($var);
        $this->TradeDate = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 Money = 5;</code>
     * @return int|string
     */
    public function getMoney()
    {
        return $this->Money;
    }

    /**
     * Generated from protobuf field <code>int64 Money = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setMoney($var)
    {
        GPBUtil::checkInt64($var);
        $this->Money = $var;

        return $this;
    }

}

