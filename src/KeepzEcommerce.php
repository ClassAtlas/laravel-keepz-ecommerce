<?php

namespace ClassAtlas\KeepzEcommerce;

use ClassAtlas\KeepzEcommerce\DataObjects\CancelOrderData;
use ClassAtlas\KeepzEcommerce\DataObjects\CheckOrderStatusData;
use ClassAtlas\KeepzEcommerce\DataObjects\CreateOrderData;
use ClassAtlas\KeepzEcommerce\DataObjects\ErrorData;
use ClassAtlas\KeepzEcommerce\DataObjects\OrderData;
use ClassAtlas\KeepzEcommerce\Requests\CancelOrderRequest;
use ClassAtlas\KeepzEcommerce\Requests\CheckOrderStatusRequest;
use ClassAtlas\KeepzEcommerce\Requests\CreateOrderRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class KeepzEcommerce
{
    private KeepzConnector $connector;

    public function __construct()
    {
        $this->connector = new KeepzConnector;
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function createOrder(OrderData $data): CreateOrderData|ErrorData
    {
        $request = new CreateOrderRequest($data);
        $response = $this->connector->send($request);

        return $response->dto();
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function checkOrderStatus(string $integratorOrderId): CheckOrderStatusData|ErrorData
    {
        $request = new CheckOrderStatusRequest($integratorOrderId);
        $response = $this->connector->send($request);

        return $response->dto();
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function cancelOrder(string $integratorOrderId): CancelOrderData
    {
        $request = new CancelOrderRequest($integratorOrderId);
        $response = $this->connector->send($request);

        return $response->dto();
    }
}
