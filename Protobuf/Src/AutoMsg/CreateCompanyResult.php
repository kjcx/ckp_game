<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.CreateCompanyResult</code>
 */
class CreateCompanyResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadCompanyInfo CompanyInfo = 1;</code>
     */
    private $CompanyInfo = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadDepartMentInfo DepartmentInfo = 2;</code>
     */
    private $DepartmentInfo = null;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadCompanyInfo CompanyInfo = 1;</code>
     * @return \AutoMsg\LoadCompanyInfo
     */
    public function getCompanyInfo()
    {
        return $this->CompanyInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadCompanyInfo CompanyInfo = 1;</code>
     * @param \AutoMsg\LoadCompanyInfo $var
     * @return $this
     */
    public function setCompanyInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadCompanyInfo::class);
        $this->CompanyInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadDepartMentInfo DepartmentInfo = 2;</code>
     * @return \AutoMsg\LoadDepartMentInfo
     */
    public function getDepartmentInfo()
    {
        return $this->DepartmentInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadDepartMentInfo DepartmentInfo = 2;</code>
     * @param \AutoMsg\LoadDepartMentInfo $var
     * @return $this
     */
    public function setDepartmentInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadDepartMentInfo::class);
        $this->DepartmentInfo = $var;

        return $this;
    }

}
