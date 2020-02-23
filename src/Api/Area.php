<?php

namespace Javleds\RedspiraApi\Api;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Area as IArea;
use Javleds\RedspiraApi\Contract\HttpClient;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
use Javleds\RedspiraApi\DataParameters\AreaParameters;
use Javleds\RedspiraApi\Entity\AreaRegistry;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;
use Javleds\RedspiraApi\Facade\DeviceRegistryRepository;

class Area extends Api implements IArea
{
    public function __construct(HttpClient $client)
    {
        parent::__construct($client);
        $this->endpoint = config('redspira.endpoints.area');
    }

    /**
     * @return Collection<AreaRegistry>
     * @throws ApiResponseException
     * @throws IncompleteParametersException
     */
    public function get(AreaParameters $parameters)
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
     * @return Collection<AreaRegistry>
     * @throws ApiResponseException
     * @throws IncompleteParametersException
     */
    public function getLastHours(string $areaId, string $parameterId, int $hours, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subHours($hours);


        $parameters = new AreaParameters(
            $areaId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            ApiParameters::HOUR_INTERVAL,
            $timeOffset
        );

        return $this->get($parameters);
    }

    /**
     * @return Collection<AreaRegistry>
     * @throws ApiResponseException
     * @throws IncompleteParametersException
     */
    public function getLastDays(string $areaId, string $parameterId, int $days, int $timeOffset = -7)
    {
        $endInterval = Carbon::now($timeOffset);

        $startInterval = clone $endInterval;
        $startInterval->subDays($days);


        $parameters = new AreaParameters(
            $areaId,
            $parameterId,
            $startInterval->toDateTime(),
            $endInterval->toDateTime(),
            ApiParameters::DAY_INTERVAL,
            $timeOffset
        );

        return $this->get($parameters);
    }
}
