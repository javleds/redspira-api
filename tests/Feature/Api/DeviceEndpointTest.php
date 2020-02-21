<?php

namespace Javleds\RedspiraApi\Tests\Feature;

use DateTime;
use Exception;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
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
            ApiParameters::HOUR_INTERVAL
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
            [ApiParameters::PM25_PARAMETER],
            [ApiParameters::PM10_PARAMETER],
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
            ApiParameters::PM10_PARAMETER,
            $hours
        );

        $size = $registries->count();

        $this->assertNotEmpty($registries);
        $this->assertSame($hours, $size);
    }

    /**
     * @throws Exception
     */
    public function testDeviceGetRegistriesByDays()
    {
        $days = 2;
        $registries = RedspiraApi::device()->getRegistriesForLastDays(
            self::DEVICE_ID,
            ApiParameters::PM10_PARAMETER,
            $days
        );

        $size = $registries->count();

        $this->assertNotEmpty($registries);

        // Add one to last days in order to get the current day values
        $expectedRecords = $days + 1;
        $this->assertSame($expectedRecords, $size);
    }
}
