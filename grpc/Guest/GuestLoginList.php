<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Guest.GuestLoginList</code>
 */
class GuestLoginList extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string sessionid = 1;</code>
     */
    protected $sessionid = '';
    /**
     * Generated from protobuf field <code>string qrcode = 2;</code>
     */
    protected $qrcode = '';
    /**
     * Generated from protobuf field <code>string clientid = 3;</code>
     */
    protected $clientid = '';
    /**
     * Generated from protobuf field <code>string storeid = 4;</code>
     */
    protected $storeid = '';
    /**
     * Generated from protobuf field <code>string typeid = 5;</code>
     */
    protected $typeid = '';
    /**
     * Generated from protobuf field <code>string orderid = 6;</code>
     */
    protected $orderid = '';
    /**
     * Generated from protobuf field <code>string orderidsimple = 7;</code>
     */
    protected $orderidsimple = '';
    /**
     * Generated from protobuf field <code>string tableno = 8;</code>
     */
    protected $tableno = '';
    /**
     * Generated from protobuf field <code>string name = 9;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>string region = 10;</code>
     */
    protected $region = '';
    /**
     * Generated from protobuf field <code>string country = 11;</code>
     */
    protected $country = '';
    /**
     * Generated from protobuf field <code>string tagline = 12;</code>
     */
    protected $tagline = '';
    /**
     * Generated from protobuf field <code>string logo = 13;</code>
     */
    protected $logo = '';
    /**
     * Generated from protobuf field <code>bool isorder = 14;</code>
     */
    protected $isorder = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionid
     *     @type string $qrcode
     *     @type string $clientid
     *     @type string $storeid
     *     @type string $typeid
     *     @type string $orderid
     *     @type string $orderidsimple
     *     @type string $tableno
     *     @type string $name
     *     @type string $region
     *     @type string $country
     *     @type string $tagline
     *     @type string $logo
     *     @type bool $isorder
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Guest::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string sessionid = 1;</code>
     * @return string
     */
    public function getSessionid()
    {
        return $this->sessionid;
    }

    /**
     * Generated from protobuf field <code>string sessionid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setSessionid($var)
    {
        GPBUtil::checkString($var, True);
        $this->sessionid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string qrcode = 2;</code>
     * @return string
     */
    public function getQrcode()
    {
        return $this->qrcode;
    }

    /**
     * Generated from protobuf field <code>string qrcode = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setQrcode($var)
    {
        GPBUtil::checkString($var, True);
        $this->qrcode = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string clientid = 3;</code>
     * @return string
     */
    public function getClientid()
    {
        return $this->clientid;
    }

    /**
     * Generated from protobuf field <code>string clientid = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setClientid($var)
    {
        GPBUtil::checkString($var, True);
        $this->clientid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string storeid = 4;</code>
     * @return string
     */
    public function getStoreid()
    {
        return $this->storeid;
    }

    /**
     * Generated from protobuf field <code>string storeid = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setStoreid($var)
    {
        GPBUtil::checkString($var, True);
        $this->storeid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string typeid = 5;</code>
     * @return string
     */
    public function getTypeid()
    {
        return $this->typeid;
    }

    /**
     * Generated from protobuf field <code>string typeid = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setTypeid($var)
    {
        GPBUtil::checkString($var, True);
        $this->typeid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string orderid = 6;</code>
     * @return string
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Generated from protobuf field <code>string orderid = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setOrderid($var)
    {
        GPBUtil::checkString($var, True);
        $this->orderid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string orderidsimple = 7;</code>
     * @return string
     */
    public function getOrderidsimple()
    {
        return $this->orderidsimple;
    }

    /**
     * Generated from protobuf field <code>string orderidsimple = 7;</code>
     * @param string $var
     * @return $this
     */
    public function setOrderidsimple($var)
    {
        GPBUtil::checkString($var, True);
        $this->orderidsimple = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string tableno = 8;</code>
     * @return string
     */
    public function getTableno()
    {
        return $this->tableno;
    }

    /**
     * Generated from protobuf field <code>string tableno = 8;</code>
     * @param string $var
     * @return $this
     */
    public function setTableno($var)
    {
        GPBUtil::checkString($var, True);
        $this->tableno = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 9;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 9;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string region = 10;</code>
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Generated from protobuf field <code>string region = 10;</code>
     * @param string $var
     * @return $this
     */
    public function setRegion($var)
    {
        GPBUtil::checkString($var, True);
        $this->region = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string country = 11;</code>
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Generated from protobuf field <code>string country = 11;</code>
     * @param string $var
     * @return $this
     */
    public function setCountry($var)
    {
        GPBUtil::checkString($var, True);
        $this->country = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string tagline = 12;</code>
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Generated from protobuf field <code>string tagline = 12;</code>
     * @param string $var
     * @return $this
     */
    public function setTagline($var)
    {
        GPBUtil::checkString($var, True);
        $this->tagline = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string logo = 13;</code>
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Generated from protobuf field <code>string logo = 13;</code>
     * @param string $var
     * @return $this
     */
    public function setLogo($var)
    {
        GPBUtil::checkString($var, True);
        $this->logo = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool isorder = 14;</code>
     * @return bool
     */
    public function getIsorder()
    {
        return $this->isorder;
    }

    /**
     * Generated from protobuf field <code>bool isorder = 14;</code>
     * @param bool $var
     * @return $this
     */
    public function setIsorder($var)
    {
        GPBUtil::checkBool($var);
        $this->isorder = $var;

        return $this;
    }

}

