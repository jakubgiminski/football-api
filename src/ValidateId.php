<?php declare(strict_types=1);

namespace App;

use InvalidArgumentException;

class ValidateId
{
    public function __invoke(string $id): void
    {
        if (preg_match('/\s/',$id)) {
            throw new InvalidArgumentException('Id must not contain any whitespaces');
        }
    }
}