<?php

namespace Javleds\RedspiraApi\Tests;

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
        ];
    }
}
