<?php

namespace Javleds\RedspiraApi\Facade;

use Illuminate\Support\Facades\Facade;
use Javleds\RedspiraApi\Entity\Area;

/**
 * @method static Area apiRegistryToDeviceRegistry(stdClass $apiRecord)
 */
class AreaRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'area-repository';
    }
}