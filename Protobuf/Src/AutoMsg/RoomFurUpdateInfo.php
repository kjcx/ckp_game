<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.RoomFurUpdateInfo</code>
 */
class RoomFurUpdateInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 ItemId = 1;</code>
     */
    private $ItemId = 0;
    /**
     * Generated from protobuf field <code>int32 FurId = 2;</code>
     */
    private $FurId = 0;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
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
     * Generated from protobuf field <code>int32 FurId = 2;</code>
     * @return int
     */
    public function getFurId()
    {
        return $this->FurId;
    }

    /**
     * Generated from protobuf field <code>int32 FurId = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setFurId($var)
    {
        GPBUtil::checkInt32($var);
        $this->FurId = $var;

        return $this;
    }

}

