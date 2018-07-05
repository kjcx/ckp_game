<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadRoleBagInfo</code>
 */
class LoadRoleBagInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int64 CurCount = 1;</code>
     */
    private $CurCount = 0;
    /**
     * Generated from protobuf field <code>int64 OnSpace = 2;</code>
     */
    private $OnSpace = 0;
    /**
     * Generated from protobuf field <code>int64 Id = 3;</code>
     */
    private $Id = 0;
    /**
     * Generated from protobuf field <code>int64 FurnitureId = 4;</code>
     */
    private $FurnitureId = 0;
    /**
     * Generated from protobuf field <code>int32 Star = 5;</code>
     */
    private $Star = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int64 CurCount = 1;</code>
     * @return int|string
     */
    public function getCurCount()
    {
        return $this->CurCount;
    }

    /**
     * Generated from protobuf field <code>int64 CurCount = 1;</code>
     * @param int|string $var
     * @return $this
     */
    public function setCurCount($var)
    {
        GPBUtil::checkInt64($var);
        $this->CurCount = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 OnSpace = 2;</code>
     * @return int|string
     */
    public function getOnSpace()
    {
        return $this->OnSpace;
    }

    /**
     * Generated from protobuf field <code>int64 OnSpace = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setOnSpace($var)
    {
        GPBUtil::checkInt64($var);
        $this->OnSpace = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 Id = 3;</code>
     * @return int|string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>int64 Id = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkInt64($var);
        $this->Id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 FurnitureId = 4;</code>
     * @return int|string
     */
    public function getFurnitureId()
    {
        return $this->FurnitureId;
    }

    /**
     * Generated from protobuf field <code>int64 FurnitureId = 4;</code>
     * @param int|string $var
     * @return $this
     */
    public function setFurnitureId($var)
    {
        GPBUtil::checkInt64($var);
        $this->FurnitureId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Star = 5;</code>
     * @return int
     */
    public function getStar()
    {
        return $this->Star;
    }

    /**
     * Generated from protobuf field <code>int32 Star = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setStar($var)
    {
        GPBUtil::checkInt32($var);
        $this->Star = $var;

        return $this;
    }

}

