<?php

namespace Javleds\RedspiraApi\Api;

use DateTime;
use DateTimeZone;
use Exception;
use Javleds\RedspiraApi\Contract\Api\DeviceInterface;

class Device extends AbstractApi implements DeviceInterface
{
    protected $endpoint = '';

    /**
     * @return mixed
     */
    public function getData(array $parameters)
    {
        return $this->getClient()->get($this->endpoint, $parameters);
    }

    /**
     * @return mixed|void
     * @throws Exception
     */
    public function getDataForLastHours(string $device, string $pollutant, int $hours, int $timeOffset = -7)
    {
        $differenceInHours = sprintf('- %d hour', $hours);
        $startInterval = new DateTime($differenceInHours, new DateTimeZone($timeOffset));

        $endInterval = new DateTime('now', new DateTimeZone($timeOffset));

        $parameters = [
            'idmonitor' => 'A0034',
            'idparam' => 'pm25',
            'interval' => 'hour',
            'datetime1' => $startInterval->format('Y-m-d H:i:s'),
            'datetime2' => $endInterval->format('Y-m-d H:i:s'),
            'timeoffset' => $timeOffset,
        ];

        return $this->getData($parameters);
    }
}