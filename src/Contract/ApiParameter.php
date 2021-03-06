<?php

namespace Javleds\RedspiraApi\Contract;

interface ApiParameter
{
    public function prepare(): array;
    public function getParameters(): array;
    public function getRequiredFields(): array;
}
