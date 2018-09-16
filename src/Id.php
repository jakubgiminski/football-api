<?php declare(strict_types=1);

namespace App;

use InvalidArgumentException;

final class Id
{
    private $value;

    public function __construct(string $value)
    {
        self::validateFormat($value);
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function validateFormat(string $value): void
    {
        if (!$value || preg_match('/\s/', $value)) {
            throw new InvalidArgumentException($value);
        }
    }
}
