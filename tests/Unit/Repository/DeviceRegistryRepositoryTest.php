<?php

namespace Javleds\RedspiraApi\Tests\Unit\Repository;

use DateTime;
use Javleds\RedspiraApi\DataParameters\DeviceParameters;
use Javleds\RedspiraApi\Facade\DeviceRegistryRepository;
use Javleds\RedspiraApi\Tests\BaseTestCaste;
use stdClass;
use TypeError;

class DeviceRegistryRepositoryTest extends BaseTestCaste
{
    /**
     * @dataProvider getIntervals
     */
    public function testApiResponseToModel(string $interval, string $dateFormat): void
    {
        $date = date($dateFormat);

        $apiRecord = new stdClass();
        $apiRecord->interval = $date;
        $apiRecord->val_prom = '1.0';
        $apiRecord->nreg = '1';
        $apiRecord->val_aqi = '1.0';

        $deviceRegistry = DeviceRegistryRepository::apiRegistryToDeviceRegistry(
            $apiRecord,
            $interval
        );

        $this->assertSame($date, $deviceRegistry->getInterval()->format($dateFormat));
        $this->assertSame(1.0, $deviceRegistry->getValProm());
        $this->assertSame(1, $deviceRegistry->getNreg());
        $this->assertSame(1.0, $deviceRegistry->getValAqi());
        $this->assertSame($interval, $deviceRegistry->getIntervalType());
    }

    public function getIntervals(): array
    {
        return [
            [DeviceParameters::HOUR_INTERVAL, DeviceParameters::ENDPOINT_DATETIME_FORMAT],
            [DeviceParameters::DAY_INTERVAL, DeviceParameters::ENDPOINT_DATE_FORMAT],
        ];
    }

    /**
     * @dataProvider getDates
     */
    public function testGetIntervalDateTime(string $date, string $dateFormat, bool $expectesExcpetion)
    {
        if ($expectesExcpetion) {
            $this->expectException(TypeError::class);
        }

        $date = DeviceRegistryRepository::getIntervalDateTime($date, $dateFormat);
        $this->assertInstanceOf(DateTime::class, $date);
    }

    public function getDates()
    {
        return [
            [date(DeviceParameters::ENDPOINT_DATE_FORMAT), DeviceParameters::DAY_INTERVAL, false],
            [date(DeviceParameters::ENDPOINT_DATE_FORMAT), DeviceParameters::HOUR_INTERVAL, true],
            [date(DeviceParameters::ENDPOINT_DATETIME_FORMAT), DeviceParameters::DAY_INTERVAL, true],
            [date(DeviceParameters::ENDPOINT_DATETIME_FORMAT), DeviceParameters::HOUR_INTERVAL, false],
        ];
    }
}