<?php

namespace Javleds\RedspiraApi\DataParameters;

use DateTime;

class AreaParameters extends ApiParameters
{

    /** @var string */
    private $areaId;

    public function __construct(
        string $areaId,
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
        $this->setAreaId($areaId);
    }

    public function getAreaId(): string
    {
        return $this->areaId;
    }

    public function setAreaId(string $areaId): void
    {
        $this->areaId = $areaId;
    }

    public function getParameters(): array
    {
        return [
            'idarea' => $this->areaId,
        ];
    }

    public function getRequiredFields(): array
    {
        return [
            'areaId',
        ];
    }
}
