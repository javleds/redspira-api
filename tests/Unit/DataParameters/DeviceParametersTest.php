<?php

namespace Javleds\RedspiraApi\Tests\Unit\DataParameters;

use Javleds\RedspiraApi\DataParameters\ApiParameters;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidParameterIdException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIntervalValueException;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DeviceParametersTest extends BaseTestCaste
{

    /**
     * @dataProvider getParameters
     *
     * @param string $parameterId
     * @param bool $shouldThrowException
     *
     * @return void
     */
    public function testDeviceParametersOnlyReceivesValidParameterIds(string $parameterId, bool $shouldThrowException)
    {
        if ($shouldThrowException) {
            $this->expectException(InvalidParameterIdException::class);
        }

        $deviceParameters = new DeviceParameters(
            'A0003',
            $parameterId,
            now(),
            now(),
            ApiParameters::HOUR_INTERVAL
        );

        $this->assertSame($parameterId, $deviceParameters->getParameterId());
    }

    public function getParameters(): array
    {
        return [
            ['someWord', true],
            ['', true],
            [ApiParameters::PM10_PARAMETER, false],
            [ApiParameters::PM25_PARAMETER, false],
        ];
    }

    /**
     * @dataProvider getIntervals
     *
     * @param string $parameterId
     * @param string $interval
     * @param bool $shouldThrowException
     *
     * @return void
     */
    public function testDeviceParametersOnlyReceivesValidIntervals(string $parameterId, string $interval, bool $shouldThrowException)
    {
        if ($shouldThrowException) {
            $this->expectException(InvalidIntervalValueException::class);
        }

        $deviceParameters = new DeviceParameters(
            'A0003',
            $parameterId,
            now(),
            now(),
            $interval
        );

        $this->assertSame($interval, $deviceParameters->getInterval());
    }

    public function getIntervals(): array
    {
        return [
            [ApiParameters::PM10_PARAMETER, 'someWord', true],
            [ApiParameters::PM10_PARAMETER, '', true],
            [ApiParameters::PM10_PARAMETER, ApiParameters::HOUR_INTERVAL, false],
            [ApiParameters::PM10_PARAMETER, ApiParameters::DAY_INTERVAL, false],
        ];
    }
}
