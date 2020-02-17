<?php

namespace Javleds\RedspiraApi\Facade;

use DateTime;
use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Entity\DeviceRegistry;
use stdClass;

/**
 * @method static DeviceRegistry apiRegistryToDeviceRegistry(stdClass $apiRecord, string $interval)
 * @method static DateTime getIntervalDateTime(string $date, string $intervalType)
 */
class DeviceRegistryRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'device-registry-repository';
    }
}