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
    const DEVICE_ID = 'A0034';
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
            self::DEVICE_ID,
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
        $hours = 12;
        $registries = RedspiraApi::device()->getRegistriesForLastHours(
            self::DEVICE_ID,
            DeviceParameters::PM10_PARAMETER,
            $hours
        );

        $size = $registries->count();

        $this->assertNotEmpty($registries);
        $this->assertSame($hours, $size);
    }
}