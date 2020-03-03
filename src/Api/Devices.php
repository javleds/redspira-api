<?php

namespace Javleds\RedspiraApi\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Devices as IDevices;
use Javleds\RedspiraApi\Contract\HttpClient;
use Javleds\RedspiraApi\Entity\Device;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Facade\DeviceRepository;

class Devices extends Api implements IDevices
{
    public function __construct(HttpClient $client)
    {
        parent::__construct($client);
        $this->endpoint = config('redspira.endpoints.devices');
    }

    /**
     * @return Collection<Device>
     * @throws ApiResponseException
     */
    public function all()
    {
        $responseRegistries = $this->getClient()->get($this->endpoint);

        if (isset($responseRegistries->error)) {
            throw new ApiResponseException($responseRegistries->error);
        }

        $registries = new Collection();
        foreach ($responseRegistries as $responseRegistry) {
            $registries->add(
                DeviceRepository::apiRegistryToDeviceRegistry(
                    $responseRegistry
                )
            );
        }

        return $registries;
    }
}
