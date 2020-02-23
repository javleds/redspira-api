<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;

interface Device extends Api
{
    /**
     * @return Collection<DeviceRegistry>
     */
    public function get(DeviceParameters $parameters);

    /**
     * @return Collection<DeviceRegistry>
     */
    public function getLastHours(string $device, string $parameterId, int $hours);

    /**
     * @return Collection<DeviceRegistry>
     */
    public function getLastDays(string $device, string $parameterId, int $days);
}
