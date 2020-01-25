<?php

namespace Javleds\RedspiraApi\Tests\Unit;

use Javleds\RedspiraApi\Tests\BaseTestCaste;

class ConfigTest extends BaseTestCaste
{
    public function testConfigHasBaseUrl()
    {
        $this->assertNotEmpty(config('redspira.base_url'));
    }

    public function testConfigHasApiBaseUrl()
    {
        $this->assertNotEmpty(config('redspira.api_base_url'));
    }
}