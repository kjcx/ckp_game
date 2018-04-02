<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.MailMsg</code>
 */
class MailMsg extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 1;</code>
     */
    private $Item;
    /**
     * Generated from protobuf field <code>string Msg = 2;</code>
     */
    private $Msg = '';
    /**
     * Generated from protobuf field <code>string SenderId = 3;</code>
     */
    private $SenderId = '';
    /**
     * Generated from protobuf field <code>int32 SendTime = 4;</code>
     */
    private $SendTime = 0;
    /**
     * Generated from protobuf field <code>string Title = 5;</code>
     */
    private $Title = '';
    /**
     * Generated from protobuf field <code>string Id = 6;</code>
     */
    private $Id = '';
    /**
     * Generated from protobuf field <code>bool Reward = 7;</code>
     */
    private $Reward = false;
    /**
     * Generated from protobuf field <code>string SenderName = 8;</code>
     */
    private $SenderName = '';
    /**
     * Generated from protobuf field <code>bool Read = 9;</code>
     */
    private $Read = false;
    /**
     * Generated from protobuf field <code>string SenderIcon = 10;</code>
     */
    private $SenderIcon = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> Item = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setItem($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT64);
        $this->Item = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Msg = 2;</code>
     * @return string
     */
    public function getMsg()
    {
        return $this->Msg;
    }

    /**
     * Generated from protobuf field <code>string Msg = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMsg($var)
    {
        GPBUtil::checkString($var, True);
        $this->Msg = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string SenderId = 3;</code>
     * @return string
     */
    public function getSenderId()
    {
        return $this->SenderId;
    }

    /**
     * Generated from protobuf field <code>string SenderId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setSenderId($var)
    {
        GPBUtil::checkString($var, True);
        $this->SenderId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 SendTime = 4;</code>
     * @return int
     */
    public function getSendTime()
    {
        return $this->SendTime;
    }

    /**
     * Generated from protobuf field <code>int32 SendTime = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setSendTime($var)
    {
        GPBUtil::checkInt32($var);
        $this->SendTime = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Title = 5;</code>
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * Generated from protobuf field <code>string Title = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setTitle($var)
    {
        GPBUtil::checkString($var, True);
        $this->Title = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Id = 6;</code>
     * @return string
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Generated from protobuf field <code>string Id = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->Id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Reward = 7;</code>
     * @return bool
     */
    public function getReward()
    {
        return $this->Reward;
    }

    /**
     * Generated from protobuf field <code>bool Reward = 7;</code>
     * @param bool $var
     * @return $this
     */
    public function setReward($var)
    {
        GPBUtil::checkBool($var);
        $this->Reward = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string SenderName = 8;</code>
     * @return string
     */
    public function getSenderName()
    {
        return $this->SenderName;
    }

    /**
     * Generated from protobuf field <code>string SenderName = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setSenderName($var)
    {
        GPBUtil::checkString($var, True);
        $this->SenderName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool Read = 9;</code>
     * @return bool
     */
    public function getRead()
    {
        return $this->Read;
    }

    /**
     * Generated from protobuf field <code>bool Read = 9;</code>
     * @param bool $var
     * @return $this
     */
    public function setRead($var)
    {
        GPBUtil::checkBool($var);
        $this->Read = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string SenderIcon = 10;</code>
     * @return string
     */
    public function getSenderIcon()
    {
        return $this->SenderIcon;
    }

    /**
     * Generated from protobuf field <code>string SenderIcon = 10;</code>
     * @param string $var
     * @return $this
     */
    public function setSenderIcon($var)
    {
        GPBUtil::checkString($var, True);
        $this->SenderIcon = $var;

        return $this;
    }

}
