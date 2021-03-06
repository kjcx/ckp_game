<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *已获得土地结构
 *
 * Generated from protobuf message <code>AutoMsg.MyLandInfoList</code>
 */
class MyLandInfoList extends \Google\Protobuf\Internal\Message
{
    /**
     *土地id
     *
     * Generated from protobuf field <code>int32 Pos = 1;</code>
     */
    private $Pos = 0;
    /**
     *获得世界
     *
     * Generated from protobuf field <code>int32 CreateTime = 2;</code>
     */
    private $CreateTime = 0;
    /**
     *金币
     *
     * Generated from protobuf field <code>int32 Gold = 3;</code>
     */
    private $Gold = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *土地id
     *
     * Generated from protobuf field <code>int32 Pos = 1;</code>
     * @return int
     */
    public function getPos()
    {
        return $this->Pos;
    }

    /**
     *土地id
     *
     * Generated from protobuf field <code>int32 Pos = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPos($var)
    {
        GPBUtil::checkInt32($var);
        $this->Pos = $var;

        return $this;
    }

    /**
     *获得世界
     *
     * Generated from protobuf field <code>int32 CreateTime = 2;</code>
     * @return int
     */
    public function getCreateTime()
    {
        return $this->CreateTime;
    }

    /**
     *获得世界
     *
     * Generated from protobuf field <code>int32 CreateTime = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setCreateTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->CreateTime = $var;

        return $this;
    }

    /**
     *金币
     *
     * Generated from protobuf field <code>int32 Gold = 3;</code>
     * @return int
     */
    public function getGold()
    {
        return $this->Gold;
    }

    /**
     *金币
     *
     * Generated from protobuf field <code>int32 Gold = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setGold($var)
    {
        GPBUtil::checkInt32($var);
        $this->Gold = $var;

        return $this;
    }

}

