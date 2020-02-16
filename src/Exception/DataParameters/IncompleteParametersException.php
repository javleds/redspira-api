<?php

namespace Javleds\RedspiraApi\Exception\DataParameters;

use Exception;
use Throwable;

class IncompleteParametersException extends Exception
{
    /**
     * IncompleteParametersException constructor.
     *
     * @param string $className
     * @param array|null $requiredFields
     * @param int|null $code
     * @param Throwable|null $previous
     */
    public function __construct(string $className, array $requiredFields = [], $code = 0, Throwable $previous = null)
    {
        $message = sprintf(
            'Class %s requires to set the parameters %s.',
            $className,
            implode(',', $requiredFields)
        );

        parent::__construct($message, $code, $previous);
    }
}