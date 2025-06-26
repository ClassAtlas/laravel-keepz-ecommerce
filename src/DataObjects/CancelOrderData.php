<?php

namespace ClassAtlas\KeepzEcommerce\DataObjects;

use ClassAtlas\KeepzEcommerce\Enums\OrderStatus;
use Spatie\LaravelData\Data;

class CancelOrderData extends Data
{
    public function __construct(
        public string      $integratorOrderId,
        public OrderStatus $status,
    )
    {
    }
}
