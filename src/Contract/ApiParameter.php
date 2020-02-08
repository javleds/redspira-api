<?php

namespace Javleds\RedspiraApi\Contract;

interface ApiParameter
{
    public function prepare(): array;
}