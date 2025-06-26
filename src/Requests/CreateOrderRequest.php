<?php

namespace ClassAtlas\KeepzEcommerce\Requests;

use ClassAtlas\KeepzEcommerce\DataObjects\CreateOrderData;
use ClassAtlas\KeepzEcommerce\DataObjects\ErrorData;
use ClassAtlas\KeepzEcommerce\DataObjects\OrderData;
use ClassAtlas\KeepzEcommerce\Traits\Cryptable;
use ClassAtlas\KeepzEcommerce\Traits\TransformsErrorResponse;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class CreateOrderRequest extends Request implements HasBody
{
    use Cryptable, HasJsonBody, TransformsErrorResponse;

    protected Method $method = Method::POST;

    public function __construct(
        protected OrderData $orderData,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/integrator/order';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): CreateOrderData|ErrorData
    {
        if (! in_array($response->status(), $this->successCodes)) {
            return $this->createErrorResponseFromJson($response->json());
        }

        $decryptedData = $this->decryptData($response->json('encryptedData'));

        return CreateOrderData::from($decryptedData);
    }

    /**
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return [
            'identifier' => config('keepz-ecommerce.integrator_id'),
            'encryptedData' => $this->encryptData($this->orderData->toArray()),
        ];
    }
}
