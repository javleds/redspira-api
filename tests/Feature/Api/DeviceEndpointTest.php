<?php

namespace Javleds\RedspiraApi\Tests\Feature;

use DateTime;
use DateTimeZone;
use Exception;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DeviceEndpointTest extends BaseTestCaste
{
    /**
     * @dataProvider getParameterIds
     *
     * @throws Exception
     */
    public function testDeviceGetRegistries(string $parameterId)
    {
        $startInterval = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00');
        $endInterval = DateTime::createFromFormat('Y-m-d H:i:s', '2020-02-08 00:00:00');

        $parameters = new DeviceParameters(
            'A0034',
            $parameterId,
            $startInterval,
            $endInterval,
            DeviceParameters::HOUR_INTERVAL
        );

        $registries = RedspiraApi::device()->getRegistries($parameters);

        $this->assertNotEmpty($registries);
    }

    /**
     * @return array<array<string>>
     */
    public function getParameterIds(): array
    {
        return [
            [DeviceParameters::PM25_PARAMETER],
            [DeviceParameters::PM10_PARAMETER],
        ];
    }

    /**
     * @throws Exception
     */
    public function testDeviceGetRegistriesByHours()
    {
        $endInterval = new DateTime();
        $startInterval = clone $endInterval;
        $startInterval->modify('- 12 hour');

        $parameters = new DeviceParameters(
            'A0034',
            DeviceParameters::PM10_PARAMETER,
            $startInterval,
            $endInterval,
            DeviceParameters::HOUR_INTERVAL
        );

        $registries = RedspiraApi::device()->getRegistries($parameters);

        $this->assertNotEmpty($registries);
    }
}