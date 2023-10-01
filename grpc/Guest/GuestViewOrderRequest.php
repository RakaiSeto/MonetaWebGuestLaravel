<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * === Items Menu ===
 *
 * Generated from protobuf message <code>Guest.GuestViewOrderRequest</code>
 */
class GuestViewOrderRequest extends \Google\Protobuf\Internal\Message
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
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $sessionid
     *     @type string $qrcode
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

}
