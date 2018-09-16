<?php declare(strict_types=1);

namespace App;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MissingParameterException extends BadRequestHttpException
{
    public function __construct(string $parameterName)
    {
        parent::__construct("Missing required parameter: $parameterName");
    }
}