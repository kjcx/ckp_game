<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TalkIngGroupChangeResult</code>
 */
class TalkIngGroupChangeResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 UpId = 1;</code>
     */
    private $UpId = 0;
    /**
     * Generated from protobuf field <code>int32 DownId = 2;</code>
     */
    private $DownId = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 UpId = 1;</code>
     * @return int
     */
    public function getUpId()
    {
        return $this->UpId;
    }

    /**
     * Generated from protobuf field <code>int32 UpId = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setUpId($var)
    {
        GPBUtil::checkInt32($var);
        $this->UpId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 DownId = 2;</code>
     * @return int
     */
    public function getDownId()
    {
        return $this->DownId;
    }

    /**
     * Generated from protobuf field <code>int32 DownId = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setDownId($var)
    {
        GPBUtil::checkInt32($var);
        $this->DownId = $var;

        return $this;
    }

}
