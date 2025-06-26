<?php

namespace ClassAtlas\KeepzEcommerce\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ClassAtlas\KeepzEcommerce\KeepzEcommerce
 */
class KeepzEcommerce extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ClassAtlas\KeepzEcommerce\KeepzEcommerce::class;
    }
}
