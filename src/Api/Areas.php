<?php

namespace Javleds\RedspiraApi\Api;

use Illuminate\Support\Collection;
use Javleds\RedspiraApi\Contract\Api\Areas as IAreas;
use Javleds\RedspiraApi\Contract\HttpClient;
use Javleds\RedspiraApi\Entity\Area;
use Javleds\RedspiraApi\Exception\ApiResponseException;
use Javleds\RedspiraApi\Facade\AreaRepository;

class Areas extends Api implements IAreas
{
    public function __construct(HttpClient $client)
    {
        parent::__construct($client);
        $this->endpoint = config('redspira.endpoints.areas');
    }

    /**
     * @return Collection<Area>
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
                AreaRepository::apiRegistryToDeviceRegistry(
                    $responseRegistry
                )
            );
        }

        return $registries;
    }
}