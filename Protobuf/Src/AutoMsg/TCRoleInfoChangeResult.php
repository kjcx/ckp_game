<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TCRoleInfoChangeResult</code>
 */
class TCRoleInfoChangeResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfo LoadRoleInfo = 1;</code>
     */
    private $LoadRoleInfo = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfo LoadRoleInfo = 1;</code>
     * @return \AutoMsg\LoadRoleInfo
     */
    public function getLoadRoleInfo()
    {
        return $this->LoadRoleInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfo LoadRoleInfo = 1;</code>
     * @param \AutoMsg\LoadRoleInfo $var
     * @return $this
     */
    public function setLoadRoleInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadRoleInfo::class);
        $this->LoadRoleInfo = $var;

        return $this;
    }

}

