<?php

namespace ClassAtlas\KeepzEcommerce\Enums;

enum OrderStatus: string
{
    case INITIAL = 'INITIAL';
    case PROCESSING = 'PROCESSING';
    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';
    case CANCELLED = 'CANCELLED';
    case EXPIRED = 'EXPIRED';
    case REFUNDED_BY_OPERATOR = 'REFUNDED_BY_OPERATOR';
    case REFUNDED_BY_INTEGRATOR = 'REFUNDED_BY_INTEGRATOR';
    case REFUNDED_BY_KEEPZ = 'REFUNDED_BY_KEEPZ';
}
