<?php

namespace Javleds\RedspiraApi\Tests\Feature;

use DateTime;
use DateTimeZone;
use Exception;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DeviceEndpointTest extends BaseTestCaste
{
    /**
     * @throws Exception
     */
    public function testDeviceGetData()
    {
        $timeOffset = -7;
        $startInterval = new DateTime('now', new DateTimeZone($timeOffset));

        $differenceInHours = sprintf('- %d hour', 12);
        $endInterval = new DateTime($differenceInHours, new DateTimeZone($timeOffset));

        $parameters = [
            'idmonitor' => 'A0034',
            'idparam' => 'pm25',
            'interval' => 'hour',
            'datetime1' => $startInterval->format('Y-m-d H:i:s'),
            'datetime2' => $endInterval->format('Y-m-d H:i:s'),
            'timeoffset' => $timeOffset,
        ];
        $response = RedspiraApi::device()->getData($parameters);

        $this->assertIsArray($response);
    }
}