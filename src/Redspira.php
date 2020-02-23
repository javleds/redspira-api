<?php

namespace Javleds\RedspiraApi;

use GuzzleHttp\ClientInterface;
use Javleds\RedspiraApi\Api\Area;
use Javleds\RedspiraApi\Api\Areas;
use Javleds\RedspiraApi\Api\Device;
use Javleds\RedspiraApi\Contract\Api\Device as IDevice;
use Javleds\RedspiraApi\Contract\Api\Areas as IAreas;
use Javleds\RedspiraApi\Contract\Api\Area as IArea;
use Javleds\RedspiraApi\Contract\HttpClient;

class Redspira
{
    /** @var ClientInterface */
    private $baseClient;

    /** @var ClientInterface */
    private $apiClient;

    public function __construct(HttpClient $baseClient, HttpClient $apiClient)
    {
        $this->baseClient = $baseClient;
        $this->apiClient = $apiClient;
    }

    public function device(): IDevice
    {
        return new Device($this->apiClient);
    }

    public function areas(): IAreas
    {
        return new Areas($this->apiClient);
    }

    public function area(): IArea
    {
        return new Area($this->apiClient);
    }
}
