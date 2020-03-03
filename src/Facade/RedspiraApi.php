<?php

namespace Javleds\RedspiraApi\Facade;

use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Contract\Api\Area;
use Javleds\RedspiraApi\Contract\Api\Areas;
use Javleds\RedspiraApi\Contract\Api\Device;
use Javleds\RedspiraApi\Contract\Api\Devices;

/**
 * @method static Devices devices()
 * @method static Device device()
 * @method static Areas areas()
 * @method static Area area()
 */
class RedspiraApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'redspira-api';
    }
}
