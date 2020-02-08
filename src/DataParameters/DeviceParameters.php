<?php

namespace Javleds\RedspiraApi\DataParameters;

use DateTime;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIdParameterException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIntervalValueException;

class DeviceParameters
{
    const PM25_PARAMETER = 'pm25';
    const PM10_PARAMETER = 'pm10';

    const HOUR_INTERVAL = 'hour';

    /** @var string */
    private $idMonitor;

    /** @var string */
    private $idParameter;

    /** @var string */
    private $interval;

    /** @var DateTime */
    private $startDate;

    /** @var DateTime */
    private $endDate;

    /** @var int */
    private $timeOffset;

    public function __construct(
        string $idMonitor,
        string $idParameter,
        DateTime $startDate = null,
        DateTime $endDate = null,
        string $interval = self::HOUR_INTERVAL,
        int $timeOffset = -7
    ) {
        $this->idMonitor = $idMonitor;
        $this->setIdParameter($idParameter);
    }

    /**
     * @return string
     */
    public function getIdMonitor(): string
    {
        return $this->idMonitor;
    }

    /**
     * @param string $idMonitor
     */
    public function setIdMonitor(string $idMonitor): void
    {
        $this->idMonitor = $idMonitor;
    }

    /**
     * @return string
     */
    public function getIdParameter(): string
    {
        return $this->idParameter;
    }

    /**
     * @param string $idParameter
     */
    public function setIdParameter(string $idParameter): void
    {
        $allowedParameters = [self::PM25_PARAMETER, self::PM10_PARAMETER];

        if (!in_array($idParameter, $allowedParameters)) {
            throw new InvalidIdParameterException($allowedParameters);
        }

        $this->idParameter = $idParameter;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     */
    public function setInterval(string $interval): void
    {
        $allowedIntervals = [self::HOUR_INTERVAL];

        if (!in_array($interval, $allowedIntervals)) {
            throw new InvalidIntervalValueException($allowedIntervals);
        }

        $this->interval = $interval;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getTimeOffset(): int
    {
        return $this->timeOffset;
    }

    /**
     * @param int $timeOffset
     */
    public function setTimeOffset(int $timeOffset): void
    {
        $this->timeOffset = $timeOffset;
    }
}