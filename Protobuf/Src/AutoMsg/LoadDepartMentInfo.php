<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.LoadDepartMentInfo</code>
 */
class LoadDepartMentInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     */
    private $FinanceInfo = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.PersonnelInfo PersonnelInfo = 2;</code>
     */
    private $PersonnelInfo = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.MarketInfo MarketInfo = 3;</code>
     */
    private $MarketInfo = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.InvestmentInfo InvestmentInfo = 4;</code>
     */
    private $InvestmentInfo = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     * @return \AutoMsg\FinanceInfo
     */
    public function getFinanceInfo()
    {
        return $this->FinanceInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.FinanceInfo FinanceInfo = 1;</code>
     * @param \AutoMsg\FinanceInfo $var
     * @return $this
     */
    public function setFinanceInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\FinanceInfo::class);
        $this->FinanceInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.PersonnelInfo PersonnelInfo = 2;</code>
     * @return \AutoMsg\PersonnelInfo
     */
    public function getPersonnelInfo()
    {
        return $this->PersonnelInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.PersonnelInfo PersonnelInfo = 2;</code>
     * @param \AutoMsg\PersonnelInfo $var
     * @return $this
     */
    public function setPersonnelInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\PersonnelInfo::class);
        $this->PersonnelInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.MarketInfo MarketInfo = 3;</code>
     * @return \AutoMsg\MarketInfo
     */
    public function getMarketInfo()
    {
        return $this->MarketInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.MarketInfo MarketInfo = 3;</code>
     * @param \AutoMsg\MarketInfo $var
     * @return $this
     */
    public function setMarketInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\MarketInfo::class);
        $this->MarketInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.InvestmentInfo InvestmentInfo = 4;</code>
     * @return \AutoMsg\InvestmentInfo
     */
    public function getInvestmentInfo()
    {
        return $this->InvestmentInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.InvestmentInfo InvestmentInfo = 4;</code>
     * @param \AutoMsg\InvestmentInfo $var
     * @return $this
     */
    public function setInvestmentInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\InvestmentInfo::class);
        $this->InvestmentInfo = $var;

        return $this;
    }

}

