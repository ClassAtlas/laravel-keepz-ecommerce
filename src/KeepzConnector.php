<?php

namespace ClassAtlas\KeepzEcommerce;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class KeepzConnector extends Connector
{
    use AcceptsJson;

    public function resolveBaseUrl(): string
    {
        return config('keepz-ecommerce.api_url');
    }
}
