<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 *谈判团居民任命返回
 *
 * Generated from protobuf message <code>AutoMsg.TalkingGroupResidentResult</code>
 */
class TalkingGroupResidentResult extends \Google\Protobuf\Internal\Message
{
    /**
     *任命返回
     *
     * Generated from protobuf field <code>repeated int32 Ids = 1;</code>
     */
    private $Ids;
    /**
     *如果是换任，这里有值 否则为nul
     *
     * Generated from protobuf field <code>repeated int32 DownId = 2;</code>
     */
    private $DownId;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     *任命返回
     *
     * Generated from protobuf field <code>repeated int32 Ids = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getIds()
    {
        return $this->Ids;
    }

    /**
     *任命返回
     *
     * Generated from protobuf field <code>repeated int32 Ids = 1;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setIds($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->Ids = $arr;

        return $this;
    }

    /**
     *如果是换任，这里有值 否则为nul
     *
     * Generated from protobuf field <code>repeated int32 DownId = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDownId()
    {
        return $this->DownId;
    }

    /**
     *如果是换任，这里有值 否则为nul
     *
     * Generated from protobuf field <code>repeated int32 DownId = 2;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDownId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->DownId = $arr;

        return $this;
    }

}

