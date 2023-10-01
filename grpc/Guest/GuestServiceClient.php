<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Guest;

/**
 */
class GuestServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Guest\RPCMonitorRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoRPCMonitor(\Guest\RPCMonitorRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoRPCMonitor',
        $argument,
        ['\Guest\RPCMonitorResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestLoginRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestLogin(\Guest\GuestLoginRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestLogin',
        $argument,
        ['\Guest\GuestLoginResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestCheckSessionRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestCheckSession(\Guest\GuestCheckSessionRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestCheckSession',
        $argument,
        ['\Guest\GuestCheckSessionResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestCategoryRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestCategory(\Guest\GuestCategoryRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestCategory',
        $argument,
        ['\Guest\GuestCategoryResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestMenuRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestMenu(\Guest\GuestMenuRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestMenu',
        $argument,
        ['\Guest\GuestMenuResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestMenuByIDRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestMenuByID(\Guest\GuestMenuByIDRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestMenuByID',
        $argument,
        ['\Guest\GuestMenuByIDResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestViewOrderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestViewOrder(\Guest\GuestViewOrderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestViewOrder',
        $argument,
        ['\Guest\GuestViewOrderResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Guest\GuestAddOrderRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DoGuestAddOrder(\Guest\GuestAddOrderRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Guest.GuestService/DoGuestAddOrder',
        $argument,
        ['\Guest\GuestAddOrderResponse', 'decode'],
        $metadata, $options);
    }

}
