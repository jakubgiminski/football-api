<?php declare(strict_types=1);

namespace App\Tests;

use App\Controller\DeleteLeagueController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteLeagueControllerTest extends FootballApiTest
{
    public function testDeletesLeague(): void
    {
        $this->objectManager->method('remove')->with($this->league);

        $deleteLeagueController = new DeleteLeagueController($this->leagueRepository, $this->objectManager);

        $jsonResponse = $deleteLeagueController((string) $this->league->getId());

        self::assertEquals($jsonResponse, new JsonResponse());
    }
}