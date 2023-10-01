<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * === Login ===
 *
 * Generated from protobuf message <code>Guest.GuestLoginRequest</code>
 */
class GuestLoginRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string qrcode = 1;</code>
     */
    protected $qrcode = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $qrcode
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Guest::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string qrcode = 1;</code>
     * @return string
     */
    public function getQrcode()
    {
        return $this->qrcode;
    }

    /**
     * Generated from protobuf field <code>string qrcode = 1;</code>
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

