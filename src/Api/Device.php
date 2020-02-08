<?php

namespace Javleds\RedspiraApi\Api;

use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\DeviceInterface;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Entity\DeviceRegistry;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;

class Device extends AbstractApi implements DeviceInterface
{
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
        $endInterval = new DateTime();

        $differenceInHours = sprintf('- %d hour', $hours);
        $startInterval = clone $endInterval;
        $startInterval->modify($differenceInHours);


        $parameters = new DeviceParameters(
            $deviceId,
            $parameterId,
            $startInterval,
            $endInterval,
            DeviceParameters::HOUR_INTERVAL
        );

        return $this->getRegistries($parameters);
    }
}