<?php

namespace Javleds\RedspiraApi\Tests\Unit\DataParameters;

use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIdParameterException;
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
            $this->expectException(InvalidIdParameterException::class);
        }

        $deviceParameters = new DeviceParameters(
            'A0003',
            $parameterId,
            now(),
            now(),
            DeviceParameters::HOUR_INTERVAL
        );

        $this->assertSame($parameterId, $deviceParameters->getIdParameter());
    }

    public function getParameters(): array
    {
        return [
            ['someWord', true],
            ['', true],
            [DeviceParameters::PM10_PARAMETER, false],
            [DeviceParameters::PM25_PARAMETER, false],
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
            [DeviceParameters::PM10_PARAMETER, 'someWord', true],
            [DeviceParameters::PM10_PARAMETER, '', true],
            [DeviceParameters::PM10_PARAMETER, DeviceParameters::HOUR_INTERVAL, false],
            [DeviceParameters::PM10_PARAMETER, DeviceParameters::MINUTE_INTERVAL, false],
        ];
    }
}
