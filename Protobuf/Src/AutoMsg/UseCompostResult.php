<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.UseCompostResult</code>
 */
class UseCompostResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadManorData LoadManor = 1;</code>
     */
    private $LoadManor = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadManorData LoadManor = 1;</code>
     * @return \AutoMsg\LoadManorData
     */
    public function getLoadManor()
    {
        return $this->LoadManor;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadManorData LoadManor = 1;</code>
     * @param \AutoMsg\LoadManorData $var
     * @return $this
     */
    public function setLoadManor($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadManorData::class);
        $this->LoadManor = $var;

        return $this;
    }

}

