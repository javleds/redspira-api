<?php

namespace Javleds\RedspiraApi\Tests;

use Javleds\RedspiraApi\Facade\AreaRegistryRepository;
use Javleds\RedspiraApi\Facade\AreaRepository;
use Javleds\RedspiraApi\Facade\DeviceRegistryRepository;
use Javleds\RedspiraApi\Facade\DeviceRepository;
use Javleds\RedspiraApi\Facade\RedspiraApi;
use Javleds\RedspiraApi\RedspiraApiServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTestCaste extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            RedspiraApiServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'RedspiraApi' => RedspiraApi::class,
            'DeviceRegistryRepository' => DeviceRegistryRepository::class,
            'DeviceRepository' => DeviceRepository::class,
            'AreaRepository' => AreaRepository::class,
            'AreaRegistryRepository' => AreaRegistryRepository::class,
        ];
    }
}
