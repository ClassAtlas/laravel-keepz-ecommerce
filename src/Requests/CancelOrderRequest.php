<?php

namespace ClassAtlas\KeepzEcommerce\Requests;

use ClassAtlas\KeepzEcommerce\DataObjects\CancelOrderData;
use ClassAtlas\KeepzEcommerce\Traits\Cryptable;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class CancelOrderRequest extends Request
{
    use Cryptable;

    protected Method $method = Method::DELETE;

    public function __construct(
        protected string $integratorOrderId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/integrator/order/cancel';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): CancelOrderData
    {
        $decryptedData = $this->decryptData($response->json('encryptedData'));

        return CancelOrderData::from($decryptedData);
    }

    public function defaultQuery(): array
    {
        return [
            'identifier' => config('keepz-ecommerce.integrator_id'),
            'encryptedData' => $this->encryptData([
                'integratorId' => config('keepz-ecommerce.integrator_id'),
                'integratorOrderId' => $this->integratorOrderId,
            ]),
        ];
    }
}
