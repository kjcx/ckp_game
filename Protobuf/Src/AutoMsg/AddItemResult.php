<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.AddItemResult</code>
 */
class AddItemResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadBagInfo BagInfo = 1;</code>
     */
    private $BagInfo = null;
    /**
     * Generated from protobuf field <code>.AutoMsg.CanChangeAttr ChangeAttr = 2;</code>
     */
    private $ChangeAttr = null;
    /**
     * Generated from protobuf field <code>int64 ShenJia = 3;</code>
     */
    private $ShenJia = 0;

    public function __construct() {
        \GPBMetadata\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadBagInfo BagInfo = 1;</code>
     * @return \AutoMsg\LoadBagInfo
     */
    public function getBagInfo()
    {
        return $this->BagInfo;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.LoadBagInfo BagInfo = 1;</code>
     * @param \AutoMsg\LoadBagInfo $var
     * @return $this
     */
    public function setBagInfo($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\LoadBagInfo::class);
        $this->BagInfo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.CanChangeAttr ChangeAttr = 2;</code>
     * @return \AutoMsg\CanChangeAttr
     */
    public function getChangeAttr()
    {
        return $this->ChangeAttr;
    }

    /**
     * Generated from protobuf field <code>.AutoMsg.CanChangeAttr ChangeAttr = 2;</code>
     * @param \AutoMsg\CanChangeAttr $var
     * @return $this
     */
    public function setChangeAttr($var)
    {
        GPBUtil::checkMessage($var, \AutoMsg\CanChangeAttr::class);
        $this->ChangeAttr = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 ShenJia = 3;</code>
     * @return int|string
     */
    public function getShenJia()
    {
        return $this->ShenJia;
    }

    /**
     * Generated from protobuf field <code>int64 ShenJia = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setShenJia($var)
    {
        GPBUtil::checkInt64($var);
        $this->ShenJia = $var;

        return $this;
    }

}
