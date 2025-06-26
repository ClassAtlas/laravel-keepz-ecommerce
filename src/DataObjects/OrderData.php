<?php

namespace ClassAtlas\KeepzEcommerce\DataObjects;

use Spatie\LaravelData\Data;

class OrderData extends Data
{
    public string $receiverType;

    public string $integratorId;

    public function __construct(
        public string $receiverId,
        public float $amount,
        public string $integratorOrderId,
        public ?string $successRedirectUri,
        public ?string $failRedirectUri,
        public ?string $callbackUri,
    ) {
        $this->receiverType = 'BRANCH';
        $this->integratorId = config('keepz-ecommerce.integrator_id');
    }
}
