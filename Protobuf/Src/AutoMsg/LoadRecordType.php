<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadRecordType</code>
 */
class LoadRecordType extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 PraiseTime = 1;</code>
     */
    private $PraiseTime = 0;
    /**
     * Generated from protobuf field <code>repeated string RecordPraiseRole = 2;</code>
     */
    private $RecordPraiseRole;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 PraiseTime = 1;</code>
     * @return int
     */
    public function getPraiseTime()
    {
        return $this->PraiseTime;
    }

    /**
     * Generated from protobuf field <code>int32 PraiseTime = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setPraiseTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->PraiseTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated string RecordPraiseRole = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getRecordPraiseRole()
    {
        return $this->RecordPraiseRole;
    }

    /**
     * Generated from protobuf field <code>repeated string RecordPraiseRole = 2;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setRecordPraiseRole($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->RecordPraiseRole = $arr;

        return $this;
    }

}
