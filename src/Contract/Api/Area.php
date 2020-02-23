<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\DataParameters\AreaParameters;
use Javleds\RedspiraApi\Entity\AreaRegistry;

interface Area
{
    /**
     * @return Collection<AreaRegistry>
     */
    public function get(AreaParameters $parameters);

    /**
     * @return Collection<AreaRegistry>
     */
    public function getLastHours(string $areaId, string $parameterId, int $hours, int $timeOffset = -7);

    /**
     * @return Collection<AreaRegistry>
     */
    public function getLastDays(string $areaId, string $parameterId, int $days, int $timeOffset = -7);
}