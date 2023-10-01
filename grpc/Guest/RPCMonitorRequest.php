<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * === RPC Monitor ===
 *
 * Generated from protobuf message <code>Guest.RPCMonitorRequest</code>
 */
class RPCMonitorRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string anyvalue = 1;</code>
     */
    protected $anyvalue = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $anyvalue
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Guest::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string anyvalue = 1;</code>
     * @return string
     */
    public function getAnyvalue()
    {
        return $this->anyvalue;
    }

    /**
     * Generated from protobuf field <code>string anyvalue = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setAnyvalue($var)
    {
        GPBUtil::checkString($var, True);
        $this->anyvalue = $var;

        return $this;
    }

}

