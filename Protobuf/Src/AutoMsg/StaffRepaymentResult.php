<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.StaffRepaymentResult</code>
 */
class StaffRepaymentResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoansInfo Loans = 1;</code>
     */
    private $Loans = null;
    /**
     * Generated from protobuf field <code>repeated int32 ListId = 2;</code>
     */
    private $ListId;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoansInfo Loans = 1;</code>
     * @return \AutoMsg\LoansInfo
     */
    public function getLoans()
    {
        return $this->Loans;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoansInfo Loans = 1;</code>
     * @param \AutoMsg\LoansInfo $var
     * @return $this
     */
    public function setLoans($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoansInfo::class);
        $this->Loans = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated int32 ListId = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getListId()
    {
        return $this->ListId;
    }

    /**
     * Generated from protobuf field <code>repeated int32 ListId = 2;</code>
     * @param int[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setListId($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::INT32);
        $this->ListId = $arr;

        return $this;
    }

}
