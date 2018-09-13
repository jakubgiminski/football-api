<?php declare(strict_types=1);

namespace App;

use Symfony\Component\HttpFoundation\Request;

class ValidateRequest
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