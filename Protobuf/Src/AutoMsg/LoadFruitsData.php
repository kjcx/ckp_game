<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadFruitsData</code>
 */
class LoadFruitsData extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     */
    private $ItemId = 0;
    /**
     * Generated from protobuf field <code>int32 FruitsId = 2;</code>
     */
    private $FruitsId = 0;
    /**
     * Generated from protobuf field <code>int32 Count = 3;</code>
     */
    private $Count = 0;
    /**
     * Generated from protobuf field <code>bool Status = 4;</code>
     */
    private $Status = false;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     * @return int
     */
    public function getItemId()
    {
        return $this->ItemId;
    }

    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setItemId($var)
    {
        GPBUtil::checkInt32($var);
        $this->ItemId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 FruitsId = 2;</code>
     * @return int
     */
    public function getFruitsId()
    {
        return $this->FruitsId;
    }

    /**
     * Generated from protobuf field <code>int32 FruitsId = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setFruitsId($var)
    {
        GPBUtil::checkInt32($var);
        $this->FruitsId = $var;

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

    /**
     * Generated from protobuf field <code>bool Status = 4;</code>
     * @return bool
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Generated from protobuf field <code>bool Status = 4;</code>
     * @param bool $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkBool($var);
        $this->Status = $var;

        return $this;
    }

}

