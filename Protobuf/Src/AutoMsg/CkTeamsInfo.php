<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.CkTeamsInfo</code>
 */
class CkTeamsInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string MemberId = 1;</code>
     */
    private $MemberId = '';
    /**
     * Generated from protobuf field <code>string MemberName = 2;</code>
     */
    private $MemberName = '';
    /**
     * Generated from protobuf field <code>string MemberNickname = 3;</code>
     */
    private $MemberNickname = '';
    /**
     * Generated from protobuf field <code>string MemberMobile = 4;</code>
     */
    private $MemberMobile = '';
    /**
     * Generated from protobuf field <code>string InviteNum = 5;</code>
     */
    private $InviteNum = '';
    /**
     * Generated from protobuf field <code>string InviteMoney = 6;</code>
     */
    private $InviteMoney = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string MemberId = 1;</code>
     * @return string
     */
    public function getMemberId()
    {
        return $this->MemberId;
    }

    /**
     * Generated from protobuf field <code>string MemberId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setMemberId($var)
    {
        GPBUtil::checkString($var, True);
        $this->MemberId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string MemberName = 2;</code>
     * @return string
     */
    public function getMemberName()
    {
        return $this->MemberName;
    }

    /**
     * Generated from protobuf field <code>string MemberName = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMemberName($var)
    {
        GPBUtil::checkString($var, True);
        $this->MemberName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string MemberNickname = 3;</code>
     * @return string
     */
    public function getMemberNickname()
    {
        return $this->MemberNickname;
    }

    /**
     * Generated from protobuf field <code>string MemberNickname = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setMemberNickname($var)
    {
        GPBUtil::checkString($var, True);
        $this->MemberNickname = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string MemberMobile = 4;</code>
     * @return string
     */
    public function getMemberMobile()
    {
        return $this->MemberMobile;
    }

    /**
     * Generated from protobuf field <code>string MemberMobile = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setMemberMobile($var)
    {
        GPBUtil::checkString($var, True);
        $this->MemberMobile = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string InviteNum = 5;</code>
     * @return string
     */
    public function getInviteNum()
    {
        return $this->InviteNum;
    }

    /**
     * Generated from protobuf field <code>string InviteNum = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setInviteNum($var)
    {
        GPBUtil::checkString($var, True);
        $this->InviteNum = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string InviteMoney = 6;</code>
     * @return string
     */
    public function getInviteMoney()
    {
        return $this->InviteMoney;
    }

    /**
     * Generated from protobuf field <code>string InviteMoney = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setInviteMoney($var)
    {
        GPBUtil::checkString($var, True);
        $this->InviteMoney = $var;

        return $this;
    }

}
