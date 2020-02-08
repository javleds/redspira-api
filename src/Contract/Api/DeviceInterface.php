<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Javleds\RedspiraApi\DataParameters\DeviceParameters;

interface DeviceInterface extends AbstractApiInterface
{
    /**
     * @return mixed
     */
    public function getData(DeviceParameters $parameters);

    /**
     * @return mixed
     */
    public function getDataForLastHours(string $device, string $pollutant, int $hours);
}