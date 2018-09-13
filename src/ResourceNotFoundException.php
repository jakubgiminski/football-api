<?php declare(strict_types=1);

namespace App;

use Exception;

class ResourceNotFoundException extends Exception
{
    public function __construct(string $resourceName)
    {
        parent::__construct("Resource $resourceName was not found", 404);
    }
}