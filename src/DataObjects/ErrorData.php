<?php

namespace ClassAtlas\KeepzEcommerce\DataObjects;

use Spatie\LaravelData\Data;

class ErrorData extends Data
{
    public function __construct(
        public string $message,
        public int    $statusCode,
        public int    $exceptionGroup
    )
    {
    }
}
