<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;

interface DeviceInterface extends AbstractApiInterface
{
    /**
     * @return Collection<DeviceRegistry>
     */
    public function getRegistries(DeviceParameters $parameters);

    /**
     * @return Collection<DeviceRegistry>
     */
    public function getDataForLastHours(string $device, string $pollutant, int $hours);
}