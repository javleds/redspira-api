<?php

namespace Javleds\RedspiraApi\DataParameters;

use Carbon\Carbon;
use DateTime;
use Javleds\RedspiraApi\Contract\ApiParameter;
use Javleds\RedspiraApi\Exception\DataParameters\IncompleteParametersException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidParameterIdException;
use Javleds\RedspiraApi\Exception\DataParameters\InvalidIntervalValueException;

abstract class ApiParameters implements ApiParameter
{
    public const PM25_PARAMETER = 'PM25';
    public const PM10_PARAMETER = 'PM10';

    public const HOUR_INTERVAL = 'hour';
    public const DAY_INTERVAL = 'day';

    public const ENDPOINT_DATETIME_FORMAT = 'Y-m-d H:i:s';
    public const ENDPOINT_DATE_FORMAT = 'Y-m-d';

    /** @var string */
    protected $parameterId;

    /** @var string */
    protected $interval;

    /** @var DateTime */
    protected $startDate;

    /** @var DateTime */
    protected $endDate;

    /** @var int */
    protected $timeOffset;

    public function __construct(
        string $parameterId,
        DateTime $startDate,
        DateTime $endDate,
        string $interval,
        int $timeOffset = -7
    ) {
        $this->setParameterId($parameterId);
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);
        $this->setInterval($interval);
        $this->setTimeOffset($timeOffset);
    }

    public function getParameterId(): string
    {
        return $this->parameterId;
    }

    public function setParameterId(string $parameterId): void
    {
        $allowedParameters = [self::PM25_PARAMETER, self::PM10_PARAMETER];

        if (!in_array($parameterId, $allowedParameters)) {
            throw new InvalidParameterIdException($allowedParameters);
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
            self::DAY_INTERVAL,
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

    protected function getBaseRequiredFields(): array
    {
        return [
            'parameterId',
            'interval',
            'startDate',
            'endDate',
        ];
    }

    protected function getBaseParameters(): array
    {
        $startInterval = Carbon::createFromFormat(
            self::ENDPOINT_DATETIME_FORMAT,
            $this->startDate->format(self::ENDPOINT_DATETIME_FORMAT),
            $this->timeOffset
        );

        $endInterval = Carbon::createFromFormat(
            self::ENDPOINT_DATETIME_FORMAT,
            $this->endDate->format(self::ENDPOINT_DATETIME_FORMAT),
            $this->timeOffset
        );

        return [
            'idparam' => $this->parameterId,
            'interval' => $this->interval,
            'datetime1' => $startInterval->toDateTimeString(),
            'datetime2' => $endInterval->toDateTimeString(),
            'timeoffset' => $this->timeOffset,
        ];
    }

    /**
     * @throws IncompleteParametersException
     */
    private function validateParameters()
    {
        $requiredParameters = array_merge(
            $this->getBaseRequiredFields(),
            $this->getRequiredFields()
        );

        if (is_null($this->startDate) || is_null($this->endDate)) {
            throw new IncompleteParametersException(self::class, $requiredParameters);
        }
    }

    /**
     * @return array
     * @throws IncompleteParametersException
     */
    public function prepare(): array
    {
        $this->validateParameters();
        return array_merge(
            $this->getBaseParameters(),
            $this->getParameters()
        );
    }
}