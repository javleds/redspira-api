<?php

namespace Javleds\RedspiraApi\Exception\DataParameters;

use InvalidArgumentException;
use Throwable;

class InvalidIdParameterException extends InvalidArgumentException
{
    /** @var string[] */
    protected $allowedIntervalValues;

    public function __construct($allowedIntervalValues, $code = 0, Throwable $previous = null)
    {
        $this->allowedIntervalValues = $allowedIntervalValues;

        $message = sprintf(
            'Parameter id is not defined as allowed types, please choose on of this options: %s',
            implode(',', $this->allowedIntervalValues)
        );

        parent::__construct($message, $code, $previous);
    }
}