<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.ManorVisitInfoTipResult</code>
 */
class ManorVisitInfoTipResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.ManorVisitInfoRes Record = 1;</code>
     */
    private $Record = null;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.ManorVisitInfoRes Record = 1;</code>
     * @return \AutoMsg\ManorVisitInfoRes
     */
    public function getRecord()
    {
        return $this->Record;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.ManorVisitInfoRes Record = 1;</code>
     * @param \AutoMsg\ManorVisitInfoRes $var
     * @return $this
     */
    public function setRecord($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\ManorVisitInfoRes::class);
        $this->Record = $var;

        return $this;
    }

}

