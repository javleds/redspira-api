<?php

namespace Javleds\RedspiraApi\Tests\Unit;

use Javleds\RedspiraApi\Api\Areas;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class AreasTest extends BaseTestCaste
{
    public function testDeviceMustReturnDeviceInterface()
    {
        $areas = RedspiraApi::areas();
        $this->assertInstanceOf(
            Areas::class,
            $areas
        );
    }

    public function testDeviceEndpoint()
    {
        $areas = RedspiraApi::areas();
        $this->assertSame(
            config('redspira.endpoints.areas'),
            $areas->getEndpoint()
        );
    }
}