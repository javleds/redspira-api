<?php

namespace Javleds\RedspiraApi\Exception;

use Exception;
use Throwable;

class ApiResponseException extends Exception
{
    /**
     * IncompleteParametersException constructor.
     *
     * @param string $error
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $error, $code = 0, Throwable $previous = null)
    {
        $message = sprintf(
            'Error on API response, got: %s.',
            $error
        );

        parent::__construct($message, $code, $previous);
    }
}
