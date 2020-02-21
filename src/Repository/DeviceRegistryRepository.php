<?php

namespace Javleds\RedspiraApi\Repository;

use DateTime;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;
use stdClass;

class DeviceRegistryRepository
{
    public function apiRegistryToDeviceRegistry(stdClass $apiRecord, string $interval): DeviceRegistry
    {
        return new DeviceRegistry(
            $this->getIntervalDateTime($apiRecord->interval, $interval),
            floatval($apiRecord->val_prom),
            intval($apiRecord->nreg),
            floatval($apiRecord->val_aqi),
            $interval
        );
    }

    public function getIntervalDateTime(string $date, string $intervalType): DateTime
    {
        switch ($intervalType) {
            case ApiParameters::HOUR_INTERVAL:
                return DateTime::createFromFormat(ApiParameters::ENDPOINT_DATETIME_FORMAT, $date);
            default:
                return DateTime::createFromFormat(ApiParameters::ENDPOINT_DATE_FORMAT, $date);
        }
    }
}