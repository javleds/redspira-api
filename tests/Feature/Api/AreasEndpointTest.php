<?php

namespace Javleds\RedspiraApi\Tests\Feature\Api;

use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DevicesEndpointTest extends BaseTestCaste
{

    public function testDeviceGetRegistries(): void
    {
        $devices = RedspiraApi::devices()->all();
        $this->assertNotEmpty($devices);
    }
}
