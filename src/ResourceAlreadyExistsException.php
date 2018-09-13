<?php declare(strict_types=1);

namespace App;

use Exception;

class ResourceAlreadyExistsException extends Exception implements ApiException
{
    public function __construct(string $resourceName)
    {
        parent::__construct("Resource $resourceName already exists", 403);
    }
}