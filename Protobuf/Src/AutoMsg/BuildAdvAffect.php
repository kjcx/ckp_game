<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.BuildAdvAffect</code>
 */
class BuildAdvAffect extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     */
    private $BuildId = '';
    /**
     * Generated from protobuf field <code>int32 AdvNumber = 2;</code>
     */
    private $AdvNumber = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     * @return string
     */
    public function getBuildId()
    {
        return $this->BuildId;
    }

    /**
     * Generated from protobuf field <code>string BuildId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setBuildId($var)
    {
        GPBUtil::checkString($var, True);
        $this->BuildId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 AdvNumber = 2;</code>
     * @return int
     */
    public function getAdvNumber()
    {
        return $this->AdvNumber;
    }

    /**
     * Generated from protobuf field <code>int32 AdvNumber = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setAdvNumber($var)
    {
        GPBUtil::checkInt32($var);
        $this->AdvNumber = $var;

        return $this;
    }

}
