<?php

namespace Javleds\RedspiraApi\Api;

use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Device as IDevice;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;

class Device extends Api implements IDevice
{
    /** @var string  */
    protected $endpoint = '';

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
                new DeviceRegistry(
                    DateTime::createFromFormat(DeviceParameters::ENDPOINT_DATE_FORMAT, $responseRegistry->interval),
                    floatval($responseRegistry->val_prom),
                    intval($responseRegistry->nreg),
                    floatval($responseRegistry->val_aqi)
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
}