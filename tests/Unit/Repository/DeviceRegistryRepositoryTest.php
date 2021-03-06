<?php

namespace Javleds\RedspiraApi\Tests\Unit\Repository;

use DateTime;
use Javleds\RedspiraApi\DataParameters\ApiParameters;
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
            [ApiParameters::HOUR_INTERVAL, ApiParameters::ENDPOINT_DATETIME_FORMAT],
            [ApiParameters::DAY_INTERVAL, ApiParameters::ENDPOINT_DATE_FORMAT],
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
            [date(ApiParameters::ENDPOINT_DATE_FORMAT), ApiParameters::DAY_INTERVAL, false],
            [date(ApiParameters::ENDPOINT_DATE_FORMAT), ApiParameters::HOUR_INTERVAL, true],
            [date(ApiParameters::ENDPOINT_DATETIME_FORMAT), ApiParameters::DAY_INTERVAL, true],
            [date(ApiParameters::ENDPOINT_DATETIME_FORMAT), ApiParameters::HOUR_INTERVAL, false],
        ];
    }
}