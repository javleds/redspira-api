<?php

namespace Javleds\RedspiraApi\Tests\Feature;

use Javleds\RedspiraApi\Contract\Api\Device;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DeviceTest extends BaseTestCaste
{
    public function testDeviceMustReturnDeviceInterface()
    {
        $device = RedspiraApi::device();
        $this->assertInstanceOf(
            Device::class,
            $device
        );
    }

    public function testDeviceEndpoint()
    {
        $device = RedspiraApi::device();
        $this->assertSame(
            config('redspira.endpoints.device'),
            $device->getEndpoint()
        );
    }
}
