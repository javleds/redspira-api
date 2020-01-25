<?php

namespace Javleds\RedspiraApi\Tests\Feature;

use Javleds\RedspiraApi\Contract\Api\DeviceInterface;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\Tests\BaseTestCaste;

class DeviceTest extends BaseTestCaste
{
    public function testDeviceMustReturnDeviceInterface()
    {
        $device = RedspiraApi::device();
        $this->assertInstanceOf(
            DeviceInterface::class,
            $device
        );
    }

    public function testDeviceEndpoint()
    {
        $device = RedspiraApi::device();
        $this->assertSame(
            '',
            $device->getEndpoint()
        );
    }
}