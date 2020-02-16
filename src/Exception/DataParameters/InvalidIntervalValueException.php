<?php


namespace Javleds\RedspiraApi\Exception\DataParameters;


use InvalidArgumentException;
use Throwable;

class InvalidIntervalValueException extends InvalidArgumentException
{
    /** @var string[] */
    protected $allowedIntervalValues;

    /**
     * @param string[] $allowedIntervalValues
     * @param int|null $code
     * @param Throwable|null $previous
     *
     * @return void
     */
    public function __construct(array $allowedIntervalValues, $code = 0, Throwable $previous = null)
    {
        $this->allowedIntervalValues = $allowedIntervalValues;

        $message = sprintf(
            'Interval type is not defined as allowed types, please choose on of this options: %s',
            implode(',', $this->allowedIntervalValues)
        );

        parent::__construct($message, $code, $previous);
    }
}