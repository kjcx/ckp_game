<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Src/protomsg.proto

namespace AutoMsg;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>AutoMsg.TalentDigReq</code>
 */
class TalentDigReq extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string ShopId = 1;</code>
     */
    private $ShopId = '';
    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
     */
    private $RoleId = '';

    public function __construct() {
        \GPBMetadata\Src\Protomsg::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string ShopId = 1;</code>
     * @return string
     */
    public function getShopId()
    {
        return $this->ShopId;
    }

    /**
     * Generated from protobuf field <code>string ShopId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setShopId($var)
    {
        GPBUtil::checkString($var, True);
        $this->ShopId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
     * @return string
     */
    public function getRoleId()
    {
        return $this->RoleId;
    }

    /**
     * Generated from protobuf field <code>string RoleId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setRoleId($var)
    {
        GPBUtil::checkString($var, True);
        $this->RoleId = $var;

        return $this;
    }

}

