<?php

namespace Javleds\RedspiraApi\Api;

use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Device as IDevice;
use Javleds\RedspiraApi\Contract\HttpClient;
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
    public function getRegistries(DeviceParameters $parameters)
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
    public function getRegistriesForLastHours(string $deviceId, string $parameterId, int $hours, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subHours($hours);


        $parameters = new DeviceParameters(
            $deviceId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            DeviceParameters::HOUR_INTERVAL,
            $timeOffset
        );

        return $this->getRegistries($parameters);
    }

    /**
     * @return Collection<DeviceRegistry>
     * @throws Exception
     */
    public function getRegistriesForLastDays(string $deviceId, string $parameterId, int $days, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subDays($days);


        $parameters = new DeviceParameters(
            $deviceId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            DeviceParameters::DAY_INTERVAL,
            $timeOffset
        );

        return $this->getRegistries($parameters);
    }
}
