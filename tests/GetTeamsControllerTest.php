<?php declare(strict_types=1);

namespace App\Tests;

use App\CollectionSerializer;
use App\Controller\GetTeamsController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetTeamsControllerTest extends FootballApiTest
{
    public function testGetsTeamsFromLeague(): void
    {
        $getTeamsController = new GetTeamsController($this->leagueRepository, new CollectionSerializer());

        $jsonResponse = $getTeamsController((string) $this->league->getId());

        self::assertEquals($jsonResponse, new JsonResponse([$this->team->toArray()]));
    }
}