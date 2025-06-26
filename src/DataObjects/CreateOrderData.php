<?php

namespace ClassAtlas\KeepzEcommerce\DataObjects;

use Spatie\LaravelData\Data;

class CreateOrderData extends Data
{
    public function __construct(
        public string $integratorOrderId,
        public string $urlForQR,
    )
    {
    }
}
