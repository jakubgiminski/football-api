<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\MissingParameterException;
use Symfony\Component\HttpFoundation\Request;

final class ValidateRequest
{
    public function __invoke(Request $request, array $requiredParameters): void
    {
        foreach ($requiredParameters as $parameter) {
            if (!$request->get($parameter)) {
                throw new MissingParameterException($parameter);
            }
        }
    }
}