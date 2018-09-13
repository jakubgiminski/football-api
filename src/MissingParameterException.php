<?php declare(strict_types=1);

namespace App;

use Exception;

class MissingParameterException extends Exception
{
    public function __construct(string $parameterName)
    {
        parent::__construct("Missing required parameter: $parameterName", 400);
    }
}