<?php

namespace Javleds\RedspiraApi\Tests\Feature\Api;

use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class AreasEndpointTest extends BaseTestCaste
{
    const DEVICE_ID = 'A0034';

    public function testDeviceGetRegistries(): void
    {
        $areas = RedspiraApi::areas()->all();
        $this->assertNotEmpty($areas);
    }
}