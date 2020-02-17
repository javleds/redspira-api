<?php

namespace Javleds\RedspiraApi\Entity;

use DateTime;

class DeviceRegistry
{
    /** @var DateTime */
    private $interval;

    /** @var float */
    private $valProm;

    /** @var int */
    private $nreg;

    /** @var float */
    private $valAqi;

    /** @var string */
    private $intervalType;

    /**
     * DeviceRegistry constructor.
     *
     * @param DateTime $interval
     * @param float $valProm
     * @param int $nreg
     * @param float $valAqi
     * @param string $intervalType
     */
    public function __construct(DateTime $interval, float $valProm, int $nreg, float $valAqi, string $intervalType)
    {
        $this->interval = $interval;
        $this->valProm  = $valProm;
        $this->nreg = $nreg;
        $this->valAqi = $valAqi;
        $this->intervalType = $intervalType;
    }

    public function getInterval(): DateTime
    {
        return $this->interval;
    }

    public function setInterval(DateTime $interval): void
    {
        $this->interval = $interval;
    }

    public function getValProm(): float
    {
        return $this->valProm;
    }

    public function setValProm(float $valProm): void
    {
        $this->valProm = $valProm;
    }

    public function getNreg(): int
    {
        return $this->nreg;
    }

    public function setNreg(int $nreg): void
    {
        $this->nreg = $nreg;
    }

    public function getValAqi(): float
    {
        return $this->valAqi;
    }

    public function setValAqi(float $valAqi): void
    {
        $this->valAqi = $valAqi;
    }

    public function getIntervalType(): string
    {
        return $this->intervalType;
    }

    public function setIntervalType(string $intervalType): void
    {
        $this->intervalType = $intervalType;
    }

}
