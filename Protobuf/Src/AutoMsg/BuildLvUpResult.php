<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.BuildLvUpResult</code>
 */
class BuildLvUpResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadBuildInfo LandBuildInfo = 1;</code>
     */
    private $LandBuildInfo;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadBuildInfo LandBuildInfo = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getLandBuildInfo()
    {
        return $this->LandBuildInfo;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadBuildInfo LandBuildInfo = 1;</code>
     * @param \AutoMsg\LoadBuildInfo[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setLandBuildInfo($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadBuildInfo::class);
        $this->LandBuildInfo = $arr;

        return $this;
    }

}

