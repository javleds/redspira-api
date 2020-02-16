<?php

namespace Javleds\RedspiraApi\Api;

use Javleds\RedspiraApi\Contract\HttpClient;

abstract class Api
{
    /** @var HttpClient */
    private $client;

    /** @var string */
    protected $endpoint;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function getClient(): HttpClient
    {
        return $this->client;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}