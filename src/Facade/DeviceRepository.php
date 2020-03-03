<?php

namespace Javleds\RedspiraApi\Facade;

use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Entity\Device;
use stdClass;

/**
 * @method static Device apiRegistryToDeviceRegistry(stdClass $apiRecord)
 */
class DeviceRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'device-repository';
    }
}
