<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: guest.proto

namespace Guest;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Guest.GuestDeleteCartResponse</code>
 */
class GuestDeleteCartResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string status = 1;</code>
     */
    protected $status = '';
    /**
     * Generated from protobuf field <code>string session = 2;</code>
     */
    protected $session = '';
    /**
     * Generated from protobuf field <code>repeated .Guest.GuestDeleteCartList results = 3;</code>
     */
    private $results;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $status
     *     @type string $session
     *     @type array<\Guest\GuestDeleteCartList>|\Google\Protobuf\Internal\RepeatedField $results
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Guest::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string status = 1;</code>
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>string status = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkString($var, True);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string session = 2;</code>
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Generated from protobuf field <code>string session = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setSession($var)
    {
        GPBUtil::checkString($var, True);
        $this->session = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .Guest.GuestDeleteCartList results = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Generated from protobuf field <code>repeated .Guest.GuestDeleteCartList results = 3;</code>
     * @param array<\Guest\GuestDeleteCartList>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setResults($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Guest\GuestDeleteCartList::class);
        $this->results = $arr;

        return $this;
    }

}

