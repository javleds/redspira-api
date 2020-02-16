<?php

namespace Javleds\RedspiraApi\Facade;

use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Contract\Api\DeviceInterface;

/**
 * @method static DeviceInterface device()
 */
class RedspiraApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'redspira-api';
    }
}