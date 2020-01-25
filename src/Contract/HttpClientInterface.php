<?php

namespace Javleds\RedspiraApi\Contract;

use GuzzleHttp\ClientInterface;

interface HttpClientInterface
{
    public function get(string $endpoint, array $params = [], array $options = []);

    public function post(string $endpoint, array $params = [], array $options = []);

}