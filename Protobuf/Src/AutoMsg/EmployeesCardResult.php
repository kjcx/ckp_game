<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.EmployeesCardResult</code>
 */
class EmployeesCardResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRefStaff LoadRefStaffList = 1;</code>
     */
    private $LoadRefStaffList = null;
    /**
     * Generated from protobuf field <code>string CompanyId = 2;</code>
     */
    private $CompanyId = '';

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRefStaff LoadRefStaffList = 1;</code>
     * @return \AutoMsg\LoadRefStaff
     */
    public function getLoadRefStaffList()
    {
        return $this->LoadRefStaffList;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRefStaff LoadRefStaffList = 1;</code>
     * @param \AutoMsg\LoadRefStaff $var
     * @return $this
     */
    public function setLoadRefStaffList($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadRefStaff::class);
        $this->LoadRefStaffList = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string CompanyId = 2;</code>
     * @return string
     */
    public function getCompanyId()
    {
        return $this->CompanyId;
    }

    /**
     * Generated from protobuf field <code>string CompanyId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setCompanyId($var)
    {
        GPBUtil::checkString($var, True);
        $this->CompanyId = $var;

        return $this;
    }

}

