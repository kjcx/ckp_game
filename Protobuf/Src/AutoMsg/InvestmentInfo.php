<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.InvestmentInfo</code>
 */
class InvestmentInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 Level = 1;</code>
     */
    private $Level = 0;
    /**
     * Generated from protobuf field <code>map<int32, int32> CurDirectorCounts = 2;</code>
     */
    private $CurDirectorCounts;
    /**
     * Generated from protobuf field <code>int32 CurStaff = 3;</code>
     */
    private $CurStaff = 0;
    /**
     * Generated from protobuf field <code>int32 CurRealestate = 4;</code>
     */
    private $CurRealestate = 0;
    /**
     * Generated from protobuf field <code>int32 CurStore = 5;</code>
     */
    private $CurStore = 0;
    /**
     * Generated from protobuf field <code>int32 CurExtension = 6;</code>
     */
    private $CurExtension = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>int32 Level = 1;</code>
     * @return int
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setLevel($var)
    {
        GPBUtil::checkInt32($var);
        $this->Level = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<int32, int32> CurDirectorCounts = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getCurDirectorCounts()
    {
        return $this->CurDirectorCounts;
    }

    /**
     * Generated from protobuf field <code>map<int32, int32> CurDirectorCounts = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setCurDirectorCounts($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT32);
        $this->CurDirectorCounts = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 CurStaff = 3;</code>
     * @return int
     */
    public function getCurStaff()
    {
        return $this->CurStaff;
    }

    /**
     * Generated from protobuf field <code>int32 CurStaff = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setCurStaff($var)
    {
        GPBUtil::checkInt32($var);
        $this->CurStaff = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 CurRealestate = 4;</code>
     * @return int
     */
    public function getCurRealestate()
    {
        return $this->CurRealestate;
    }

    /**
     * Generated from protobuf field <code>int32 CurRealestate = 4;</code>
     * @param int $var
     * @return $this
     */
    public function setCurRealestate($var)
    {
        GPBUtil::checkInt32($var);
        $this->CurRealestate = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 CurStore = 5;</code>
     * @return int
     */
    public function getCurStore()
    {
        return $this->CurStore;
    }

    /**
     * Generated from protobuf field <code>int32 CurStore = 5;</code>
     * @param int $var
     * @return $this
     */
    public function setCurStore($var)
    {
        GPBUtil::checkInt32($var);
        $this->CurStore = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 CurExtension = 6;</code>
     * @return int
     */
    public function getCurExtension()
    {
        return $this->CurExtension;
    }

    /**
     * Generated from protobuf field <code>int32 CurExtension = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setCurExtension($var)
    {
        GPBUtil::checkInt32($var);
        $this->CurExtension = $var;

        return $this;
    }

}
