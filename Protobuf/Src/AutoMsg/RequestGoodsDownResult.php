<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RequestGoodsDownResult</code>
 */
class RequestGoodsDownResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bool Status = 1;</code>
     */
    private $Status = false;
    /**
     * Generated from protobuf field <code>int32 ItemID = 2;</code>
     */
    private $ItemID = 0;
    /**
     * Generated from protobuf field <code>int32 Count = 3;</code>
     */
    private $Count = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>bool Status = 1;</code>
     * @return bool
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>bool Status = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkBool($var);
        $this->Status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 ItemID = 2;</code>
     * @return int
     */
    public function getItemID()
    {
        return $this->ItemID;
    }

    /**
     * Generated from protobuf field <code>int32 ItemID = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setItemID($var)
    {
        GPBUtil::checkInt32($var);
        $this->ItemID = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Count = 3;</code>
     * @return int
     */
    public function getCount()
    {
        return $this->Count;
    }

    /**
     * Generated from protobuf field <code>int32 Count = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setCount($var)
    {
        GPBUtil::checkInt32($var);
        $this->Count = $var;

        return $this;
    }

}

