<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.GetPraiseRoleIdResult</code>
 */
class GetPraiseRoleIdResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfos LoadRoleInfos = 1;</code>
     */
    private $LoadRoleInfos = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfos LoadRoleInfos = 1;</code>
     * @return \AutoMsg\LoadRoleInfos
     */
    public function getLoadRoleInfos()
    {
        return $this->LoadRoleInfos;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadRoleInfos LoadRoleInfos = 1;</code>
     * @param \AutoMsg\LoadRoleInfos $var
     * @return $this
     */
    public function setLoadRoleInfos($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadRoleInfos::class);
        $this->LoadRoleInfos = $var;

        return $this;
    }

}

