<?php

namespace Javleds\RedspiraApi\Tests\Unit;

use Javleds\RedspiraApi\Tests\BaseTestCaste;

class ConfigTest extends BaseTestCaste
{
    /**
     * @dataProvider getConfigPKeys
     */
    public function testConfigHasKey(string $key): void
    {
        $this->assertNotEmpty(config($key));
    }

    public function getConfigPKeys(): array
    {
        return [
            ['redspira.base_url'],
            ['redspira.api_base_url'],
            ['redspira.endpoints.device'],
            ['redspira.endpoints.area'],
            ['redspira.endpoints.area_tree'],
            ['redspira.endpoints.devices'],
        ];
    }
}
