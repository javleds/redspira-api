<?php

namespace Javleds\RedspiraApi\DataParameters;

use Carbon\Carbon;
use DateTime;
use Exception;
use Javleds\RedspiraApi\Contract\ApiParameter;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIdParameterException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIntervalValueException;

class DeviceParameters implements ApiParameter
{
    public const PM25_PARAMETER = 'PM25';
    public const PM10_PARAMETER = 'PM10';

    public const HOUR_INTERVAL = 'hour';
    public const MINUTE_INTERVAL = 'minute';

    public const ENDPOINT_DATE_FORMAT = 'Y-m-d H:i:s';

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

    public function getMonitorId(): string
    {
        return $this->monitorId;
    }

    public function setMonitorId(string $monitorId): void
    {
        $this->monitorId = $monitorId;
    }

    public function getIdParameter(): string
    {
        return $this->parameterId;
    }

    public function setIdParameter(string $parameterId): void
    {
        $allowedParameters = [self::PM25_PARAMETER, self::PM10_PARAMETER];

        if (!in_array($parameterId, $allowedParameters)) {
            throw new InvalidIdParameterException($allowedParameters);
        }

        $this->parameterId = $parameterId;
    }

    public function getInterval(): string
    {
        return $this->interval;
    }

    public function setInterval(string $interval): void
    {
        $allowedIntervals = [
            self::HOUR_INTERVAL,
            self::MINUTE_INTERVAL,
        ];

        if (!in_array($interval, $allowedIntervals)) {
            throw new InvalidIntervalValueException($allowedIntervals);
        }

        $this->interval = $interval;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getTimeOffset(): int
    {
        return $this->timeOffset;
    }

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

        $startInterval->subHours(1);

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
