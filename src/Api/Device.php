<?php

namespace Javleds\RedspiraApi\Api;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Device as IDevice;
use Javleds\RedspiraApi\Contract\HttpClient;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;
use Javleds\RedspiraApi\Facade\DeviceRegistryRepository;

class Device extends Api implements IDevice
{
    public function __construct(HttpClient $client)
    {
        parent::__construct($client);
        $this->endpoint = config('redspira.endpoints.device');
    }

    /**
     * @return Collection<DeviceRegistry>
     * @throws IncompleteParametersException
     * @throws ApiResponseException
     */
    public function get(DeviceParameters $parameters)
    {
        $responseRegistries = $this->getClient()->get($this->endpoint, $parameters->prepare());

        if (isset($responseRegistries->error)) {
            throw new ApiResponseException($responseRegistries->error);
        }

        $registries = new Collection();
        foreach ($responseRegistries as $responseRegistry) {
            $registries->add(
                DeviceRegistryRepository::apiRegistryToDeviceRegistry(
                    $responseRegistry,
                    $parameters->getInterval()
                )
            );
        }

        return $registries;
    }

    /**
     * @return Collection<DeviceRegistry>
     * @throws Exception
     */
    public function getLastHours(string $deviceId, string $parameterId, int $hours, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subHours($hours);

        if ($endInterval->hour !== 0) {
            $startInterval->subHours(1);
        }

        $parameters = new DeviceParameters(
            $deviceId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            ApiParameters::HOUR_INTERVAL,
            $timeOffset
        );

        return $this->get($parameters);
    }

    /**
     * @return Collection<DeviceRegistry>
     * @throws Exception
     */
    public function getLastDays(string $deviceId, string $parameterId, int $days, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subDays($days);

        if ($endInterval->hour !== 0) {
            $startInterval->subDays(- 1);
        }

        $parameters = new DeviceParameters(
            $deviceId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            ApiParameters::DAY_INTERVAL,
            $timeOffset
        );

        return $this->get($parameters);
    }
}
