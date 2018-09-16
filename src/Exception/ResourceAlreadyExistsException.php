<?php declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ResourceAlreadyExistsException extends BadRequestHttpException
{
    public function __construct(string $resourceName)
    {
        parent::__construct("Resource $resourceName already exists");
    }
}