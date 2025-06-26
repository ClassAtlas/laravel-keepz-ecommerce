<?php

namespace ClassAtlas\KeepzEcommerce\Requests;

use ClassAtlas\KeepzEcommerce\DataObjects\CheckOrderStatusData;
use ClassAtlas\KeepzEcommerce\DataObjects\ErrorData;
use ClassAtlas\KeepzEcommerce\Traits\Cryptable;
use ClassAtlas\KeepzEcommerce\Traits\TransformsErrorResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class CheckOrderStatusRequest extends Request
{
    use Cryptable, TransformsErrorResponse;

    protected Method $method = Method::GET;

    public function __construct(
        public string $integratorOrderId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/api/integrator/order/status';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): CheckOrderStatusData|ErrorData
    {
        if (! in_array($response->status(), $this->successCodes)) {
            return $this->createErrorResponseFromJson($response->json());
        }

        $decryptedData = $this->decryptData($response->json('encryptedData'));

        return CheckOrderStatusData::from($decryptedData);
    }

    public function defaultQuery(): array
    {
        return [
            'identifier' => config('keepz-ecommerce.integrator_id'),
            'encryptedData' => $this->encryptData([
                'integratorOrderId' => $this->integratorOrderId,
                'integratorId' => config('keepz-ecommerce.integrator_id'),
            ]),
        ];
    }
}
