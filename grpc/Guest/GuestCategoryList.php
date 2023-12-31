<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Guest.GuestCategoryList</code>
 */
class GuestCategoryList extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string categoryid = 1;</code>
     */
    protected $categoryid = '';
    /**
     * Generated from protobuf field <code>string name = 2;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>string description = 3;</code>
     */
    protected $description = '';
    /**
     * Generated from protobuf field <code>string imageurl = 4;</code>
     */
    protected $imageurl = '';
    /**
     * Generated from protobuf field <code>double totalmenu = 5;</code>
     */
    protected $totalmenu = 0.0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $categoryid
     *     @type string $name
     *     @type string $description
     *     @type string $imageurl
     *     @type float $totalmenu
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Guest::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string categoryid = 1;</code>
     * @return string
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Generated from protobuf field <code>string categoryid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setCategoryid($var)
    {
        GPBUtil::checkString($var, True);
        $this->categoryid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 2;</code>
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
     * Generated from protobuf field <code>string description = 3;</code>
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Generated from protobuf field <code>string description = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string imageurl = 4;</code>
     * @return string
     */
    public function getImageurl()
    {
        return $this->imageurl;
    }

    /**
     * Generated from protobuf field <code>string imageurl = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setImageurl($var)
    {
        GPBUtil::checkString($var, True);
        $this->imageurl = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>double totalmenu = 5;</code>
     * @return float
     */
    public function getTotalmenu()
    {
        return $this->totalmenu;
    }

    /**
     * Generated from protobuf field <code>double totalmenu = 5;</code>
     * @param float $var
     * @return $this
     */
    public function setTotalmenu($var)
    {
        GPBUtil::checkDouble($var);
        $this->totalmenu = $var;

        return $this;
    }

}

