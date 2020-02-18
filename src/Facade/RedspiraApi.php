<?php

namespace Javleds\RedspiraApi\Facade;

use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Contract\Api\Areas;
use Javleds\RedspiraApi\Contract\Api\Device;

/**
 * @method static Device device()
 * @method static Areas areas()
 */
class RedspiraApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'redspira-api';
    }
}
