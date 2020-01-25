<?php

namespace Javleds\RedspiraApi\Api;

use Javleds\RedspiraApi\Contract\HttpClientInterface;

abstract class AbstractApi
{
    /** @var HttpClientInterface */
    private $client;

    /** @var string */
    protected $endpoint;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}