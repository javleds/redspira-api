<?php

namespace Javleds\RedspiraApi\Facade;

use DateTime;
use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Entity\AreaRegistry;
use stdClass;

/**
 * @method static AreaRegistry apiRegistryToDeviceRegistry(stdClass $apiRecord, string $interval)
 * @method static DateTime getIntervalDateTime(string $date, string $intervalType)
 */
class AreaRegistryRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'area-registry-repository';
    }
}
