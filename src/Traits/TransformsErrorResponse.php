<?php

namespace ClassAtlas\KeepzEcommerce\Traits;

use ClassAtlas\KeepzEcommerce\DataObjects\ErrorData;

trait TransformsErrorResponse
{
    /**
     * @var array<int>
     */
    protected array $successCodes = [200, 201];

    protected function createErrorResponseFromJson(mixed $responseJson): ErrorData
    {
        return ErrorData::from($responseJson);
    }

    protected function createCustomErrorResponse(string $message, int $statusCode): ErrorData
    {
        return new ErrorData(
            $message,
            $statusCode,
            0,
        );
    }
}
