<?php

namespace Javleds\RedspiraApi;

use GuzzleHttp\ClientInterface;
use Javleds\RedspiraApi\Api\Device;
use Javleds\RedspiraApi\Contract\Api\DeviceInterface;
use Javleds\RedspiraApi\Contract\HttpClientInterface;

class Redspira
{
    /** @var ClientInterface */
    private $baseClient;

    /** @var ClientInterface */
    private $apiClient;

    public function __construct(HttpClientInterface $baseClient, HttpClientInterface $apiClient)
    {
        $this->baseClient = $baseClient;
        $this->apiClient = $apiClient;
    }

    public function device(): DeviceInterface
    {
        return new Device($this->apiClient);
    }
}