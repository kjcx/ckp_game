<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.CKRichResult</code>
 */
class CKRichResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string Point = 1;</code>
     */
    private $Point = '';
    /**
     * Generated from protobuf field <code>string Predepoit = 2;</code>
     */
    private $Predepoit = '';
    /**
     * Generated from protobuf field <code>string Voucher = 3;</code>
     */
    private $Voucher = '';
    /**
     * Generated from protobuf field <code>string Credit = 4;</code>
     */
    private $Credit = '';
    /**
     * Generated from protobuf field <code>string Team = 5;</code>
     */
    private $Team = '';
    /**
     * Generated from protobuf field <code>string Invite = 6;</code>
     */
    private $Invite = '';
    /**
     * Generated from protobuf field <code>string Chuangke_invite = 7;</code>
     */
    private $Chuangke_invite = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string Point = 1;</code>
     * @return string
     */
    public function getPoint()
    {
        return $this->Point;
    }

    /**
     * Generated from protobuf field <code>string Point = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setPoint($var)
    {
        GPBUtil::checkString($var, True);
        $this->Point = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Predepoit = 2;</code>
     * @return string
     */
    public function getPredepoit()
    {
        return $this->Predepoit;
    }

    /**
     * Generated from protobuf field <code>string Predepoit = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setPredepoit($var)
    {
        GPBUtil::checkString($var, True);
        $this->Predepoit = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Voucher = 3;</code>
     * @return string
     */
    public function getVoucher()
    {
        return $this->Voucher;
    }

    /**
     * Generated from protobuf field <code>string Voucher = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setVoucher($var)
    {
        GPBUtil::checkString($var, True);
        $this->Voucher = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Credit = 4;</code>
     * @return string
     */
    public function getCredit()
    {
        return $this->Credit;
    }

    /**
     * Generated from protobuf field <code>string Credit = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setCredit($var)
    {
        GPBUtil::checkString($var, True);
        $this->Credit = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Team = 5;</code>
     * @return string
     */
    public function getTeam()
    {
        return $this->Team;
    }

    /**
     * Generated from protobuf field <code>string Team = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setTeam($var)
    {
        GPBUtil::checkString($var, True);
        $this->Team = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Invite = 6;</code>
     * @return string
     */
    public function getInvite()
    {
        return $this->Invite;
    }

    /**
     * Generated from protobuf field <code>string Invite = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setInvite($var)
    {
        GPBUtil::checkString($var, True);
        $this->Invite = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string Chuangke_invite = 7;</code>
     * @return string
     */
    public function getChuangkeInvite()
    {
        return $this->Chuangke_invite;
    }

    /**
     * Generated from protobuf field <code>string Chuangke_invite = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setChuangkeInvite($var)
    {
        GPBUtil::checkString($var, True);
        $this->Chuangke_invite = $var;

        return $this;
    }

}

