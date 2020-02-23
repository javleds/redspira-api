<?php

namespace Javleds\RedspiraApi\Tests\Feature\Api;

use DateTime;
use Exception;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
use Javleds\RedspiraApi\DataParameters\AreaParameters;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class AreasEndpointTest extends BaseTestCaste
{
    const AREA_ID = 2002;

    /**
     * @dataProvider getParameterIds
     *
     * @throws Exception
     */
    public function testGetRegistries(string $parameterId)
    {
        $startInterval = DateTime::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00');
        $endInterval = DateTime::createFromFormat('Y-m-d H:i:s', '2020-02-08 00:00:00');

        $parameters = new AreaParameters(
            self::AREA_ID,
            $parameterId,
            $startInterval,
            $endInterval,
            ApiParameters::HOUR_INTERVAL
        );

        $registries = RedspiraApi::area()->get($parameters);

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
    public function testGetRegistriesByHours()
    {
        $hours = 12;
        $registries = RedspiraApi::area()->getLastHours(
            self::AREA_ID,
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
    public function testGetRegistriesByDays()
    {
        $days = 2;
        $registries = RedspiraApi::area()->getLastDays(
            self::AREA_ID,
            ApiParameters::PM10_PARAMETER,
            $days
        );

        $size = $registries->count();

        $this->assertNotEmpty($registries);

        // Add one to last days in order to get the current day values
        $expectedRecords = $days;
        $this->assertSame($expectedRecords, $size);
    }
}