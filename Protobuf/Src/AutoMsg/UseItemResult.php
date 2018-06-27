<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.UseItemResult</code>
 */
class UseItemResult extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.AutoMsg.LoadBagInfo BagInfo = 1;</code>
     */
    private $BagInfo = null;
    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadUserAttr ChangeAttr = 2;</code>
     */
    private $ChangeAttr;
    /**
     * Generated from protobuf field <code>int32 Shenjia = 3;</code>
     */
    private $Shenjia = 0;
    /**
     * Generated from protobuf field <code>int32 Level = 4;</code>
     */
    private $Level = 0;
    /**
     * Generated from protobuf field <code>int64 Exp = 5;</code>
     */
    private $Exp = 0;
    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 6;</code>
     */
    private $ItemCount;

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
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
     * Generated from protobuf field <code>repeated .AutoMsg.LoadUserAttr ChangeAttr = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getChangeAttr()
    {
        return $this->ChangeAttr;
    }

    /**
     * Generated from protobuf field <code>repeated .AutoMsg.LoadUserAttr ChangeAttr = 2;</code>
     * @param \AutoMsg\LoadUserAttr[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setChangeAttr($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \AutoMsg\LoadUserAttr::class);
        $this->ChangeAttr = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Shenjia = 3;</code>
     * @return int
     */
    public function getShenjia()
    {
        return $this->Shenjia;
    }

    /**
     * Generated from protobuf field <code>int32 Shenjia = 3;</code>
     * @param int $var
     * @return $this
     */
    public function setShenjia($var)
    {
        GPBUtil::checkInt32($var);
        $this->Shenjia = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 4;</code>
     * @return int
     */
    public function getLevel()
    {
        return $this->Level;
    }

    /**
     * Generated from protobuf field <code>int32 Level = 4;</code>
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
     * Generated from protobuf field <code>int64 Exp = 5;</code>
     * @return int|string
     */
    public function getExp()
    {
        return $this->Exp;
    }

    /**
     * Generated from protobuf field <code>int64 Exp = 5;</code>
     * @param int|string $var
     * @return $this
     */
    public function setExp($var)
    {
        GPBUtil::checkInt64($var);
        $this->Exp = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 6;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getItemCount()
    {
        return $this->ItemCount;
    }

    /**
     * Generated from protobuf field <code>map<int32, int64> ItemCount = 6;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setItemCount($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::INT32, \Google\Protobuf\Internal\GPBType::INT64);
        $this->ItemCount = $arr;

        return $this;
    }

}

