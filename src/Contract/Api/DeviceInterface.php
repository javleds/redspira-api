<?php

namespace Javleds\RedspiraApi\Contract\Api;

interface DeviceInterface extends AbstractApiInterface
{
    /**
     * @return mixed
     */
    public function getData(array $parameters);

    /**
     * @return mixed
     */
    public function getDataForLastHours(string $device, string $pollutant, int $hours);
}