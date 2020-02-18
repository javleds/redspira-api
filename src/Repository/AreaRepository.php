<?php

namespace Javleds\RedspiraApi\Repository;

use Javleds\RedspiraApi\Entity\Area;
use stdClass;

class AreaRepository
{
    public function apiRegistryToDeviceRegistry(stdClass $apiRecord): Area
    {
        return new Area(
            intval($apiRecord->idarea),
            $apiRecord->descarea,
            intval($apiRecord->parent) ?? null
        );
    }
}