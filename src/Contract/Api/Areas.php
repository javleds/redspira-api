<?php

namespace Javleds\RedspiraApi\Contract\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Entity\Area;

interface Areas extends Api
{
    /**
     * @return Collection<Area>
     */
    public function all();
}