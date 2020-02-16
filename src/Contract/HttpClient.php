<?php

namespace Javleds\RedspiraApi\Contract;

interface HttpClient
{
    public function get(string $endpoint, array $params = [], array $options = []);

    public function post(string $endpoint, array $params = [], array $options = []);

}
