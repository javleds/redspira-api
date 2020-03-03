<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Entity\Device;

interface Devices extends Api
{
    /**
     * @return Collection<Device>
     */
    public function all();
}
