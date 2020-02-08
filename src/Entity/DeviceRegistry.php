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

    /**
     * DeviceRegistry constructor.
     *
     * @param DateTime $interval
     * @param float $valProm
     * @param int $nreg
     * @param float $valAqi
     */
    public function __construct(DateTime $interval, float $valProm, int $nreg, float $valAqi)
    {
        $this->interval = $interval;
        $this->valProm  = $valProm;
        $this->nreg     = $nreg;
        $this->valAqi   = $valAqi;
    }

    /**
     * @return DateTime
     */
    public function getInterval(): DateTime
    {
        return $this->interval;
    }

    /**
     * @param DateTime $interval
     */
    public function setInterval(DateTime $interval): void
    {
        $this->interval = $interval;
    }

    /**
     * @return float
     */
    public function getValProm(): float
    {
        return $this->valProm;
    }

    /**
     * @param float $valProm
     */
    public function setValProm(float $valProm): void
    {
        $this->valProm = $valProm;
    }

    /**
     * @return int
     */
    public function getNreg(): int
    {
        return $this->nreg;
    }

    /**
     * @param int $nreg
     */
    public function setNreg(int $nreg): void
    {
        $this->nreg = $nreg;
    }

    /**
     * @return float
     */
    public function getValAqi(): float
    {
        return $this->valAqi;
    }

    /**
     * @param float $valAqi
     */
    public function setValAqi(float $valAqi): void
    {
        $this->valAqi = $valAqi;
    }

}