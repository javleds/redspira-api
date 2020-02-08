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
     * @param string $idParameter
     * @param bool $shouldThrowException
     *
     * @return void
     */
    public function testDeviceParametersOnlyReceivesValidParameters(string $idParameter, bool $shouldThrowException)
    {
        if ($shouldThrowException) {
            $this->expectException(InvalidIdParameterException::class);
        }

        $deviceParameters = new DeviceParameters(
            'A0003',
            $idParameter
        );

        $this->assertSame($idParameter, $deviceParameters->getIdParameter());
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
     * @param string $idParameter
     * @param string $interval
     * @param bool $shouldThrowException
     *
     * @return void
     */
    public function testDeviceParametersOnlyReceivesValidIntervals(string $idParameter, string $interval, bool $shouldThrowException)
    {
        if ($shouldThrowException) {
            $this->expectException(InvalidIntervalValueException::class);
        }

        $deviceParameters = new DeviceParameters(
            'A0003',
            $idParameter
        );

        $deviceParameters->setInterval($interval);

        $this->assertSame($interval, $deviceParameters->getInterval());
    }

    public function getIntervals(): array
    {
        return [
            [DeviceParameters::PM10_PARAMETER, 'someWord', true],
            [DeviceParameters::PM10_PARAMETER, '', true],
            [DeviceParameters::PM10_PARAMETER, DeviceParameters::HOUR_INTERVAL, false],
        ];
    }
}