<?php

namespace Javleds\RedspiraApi\Exception;

use InvalidArgumentException;
use Throwable;

class InvalidLastHoursException extends InvalidArgumentException
{
    /**
     * @param int|null $code
     * @param Throwable|null $previous
     *
     * @return void
     */
    public function __construct($code = 0, Throwable $previous = null)
    {
        $message = "Last hours could not be lower than 0.";
        parent::__construct($message, $code, $previous);
    }
}