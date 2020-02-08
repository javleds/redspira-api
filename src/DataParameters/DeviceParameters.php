<?php

namespace Javleds\RedspiraApi\DataParameters;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Exception;
use Javleds\RedspiraApi\Contract\ApiParameter;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIdParameterException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIntervalValueException;

class DeviceParameters implements ApiParameter
{
    const PM25_PARAMETER = 'PM25';
    const PM10_PARAMETER = 'PM10';

    const HOUR_INTERVAL = 'hour';

    const ENDPOINT_DATE_FORMAT = 'Y-m-d H:i:s';

    /** @var string */
    private $monitorId;

    /** @var string */
    private $parameterId;

    /** @var string */
    private $interval;

    /** @var DateTime */
    private $startDate;

    /** @var DateTime */
    private $endDate;

    /** @var int */
    private $timeOffset;

    public function __construct(
        string $monitorId,
        string $parameterId,
        DateTime $startDate,
        DateTime $endDate,
        string $interval,
        int $timeOffset = -7
    ) {
        $this->setMonitorId($monitorId);
        $this->setIdParameter($parameterId);
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);
        $this->setInterval($interval);
        $this->setTimeOffset($timeOffset);
    }

    /**
     * @return string
     */
    public function getMonitorId(): string
    {
        return $this->monitorId;
    }

    /**
     * @param string $monitorId
     */
    public function setMonitorId(string $monitorId): void
    {
        $this->monitorId = $monitorId;
    }

    /**
     * @return string
     */
    public function getIdParameter(): string
    {
        return $this->parameterId;
    }

    /**
     * @param string $parameterId
     */
    public function setIdParameter(string $parameterId): void
    {
        $allowedParameters = [self::PM25_PARAMETER, self::PM10_PARAMETER];

        if (!in_array($parameterId, $allowedParameters)) {
            throw new InvalidIdParameterException($allowedParameters);
        }

        $this->parameterId = $parameterId;
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

    /**
     * @return array
     * @throws IncompleteParametersException
     * @throws Exception
     */
    public function prepare(): array
    {
        if (is_null($this->startDate) || is_null($this->endDate)) {
            throw new IncompleteParametersException(self::class, [
                'monitorId',
                'parameterId',
                'interval',
                'startDate',
                'endDate',
            ]);
        }

        $startInterval = Carbon::createFromFormat(
            self::ENDPOINT_DATE_FORMAT,
            $this->startDate->format(self::ENDPOINT_DATE_FORMAT),
            $this->timeOffset
        );

        $endInterval = Carbon::createFromFormat(
            self::ENDPOINT_DATE_FORMAT,
            $this->endDate->format(self::ENDPOINT_DATE_FORMAT),
            $this->timeOffset
        );

        return [
            'idmonitor' => $this->monitorId,
            'idparam' => $this->parameterId,
            'interval' => $this->interval,
            'datetime1' => $startInterval->toDateTimeString(),
            'datetime2' => $endInterval->toDateTimeString(),
            'timeoffset' => $this->timeOffset,
        ];
    }
}