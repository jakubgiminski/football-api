<?php declare(strict_types=1);

namespace App;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ResourceAlreadyExistsException extends BadRequestHttpException
{
    public function __construct(string $resourceName)
    {
        parent::__construct("Resource $resourceName already exists");
    }
}