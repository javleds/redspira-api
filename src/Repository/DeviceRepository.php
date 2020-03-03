<?php

namespace Javleds\RedspiraApi\Repository;

use Javleds\RedspiraApi\Entity\Device;
use stdClass;

class DeviceRepository
{
    public function apiRegistryToDeviceRegistry(stdClass $apiRecord): Device
    {
        return new Device(
            $apiRecord->idmonitor,
            $apiRecord->descmonitor ?? '',
            floatval($apiRecord->x ?? 0),
            floatval($apiRecord->y ?? 0),
            $apiRecord->descpatrocinio ?? '',
            $apiRecord->logo ?? '',
            $apiRecord->enlace ?? '',
            $apiRecord->tipo ?? ''
        );
    }
}
