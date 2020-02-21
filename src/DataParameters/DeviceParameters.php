<?php

namespace Javleds\RedspiraApi\DataParameters;

use DateTime;

class DeviceParameters extends ApiParameters
{
    /** @var string */
    private $monitorId;

    public function __construct(
        string $monitorId,
        string $parameterId,
        DateTime $startDate,
        DateTime $endDate,
        string $interval,
        int $timeOffset = -7
    ) {
        parent::__construct(
            $parameterId,
            $startDate,
            $endDate,
            $interval,
            $timeOffset
        );
        $this->setMonitorId($monitorId);
    }

    public function getMonitorId(): string
    {
        return $this->monitorId;
    }

    public function setMonitorId(string $monitorId): void
    {
        $this->monitorId = $monitorId;
    }

    public function getParameters(): array
    {
        return [
            'idmonitor' => $this->monitorId,
        ];
    }

    public function getRequiredFields(): array
    {
        return [
            'monitorId',
        ];
    }
}
