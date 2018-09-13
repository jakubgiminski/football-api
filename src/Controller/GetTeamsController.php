<?php declare(strict_types=1);

namespace App\Controller;

use App\CollectionSerializer;
use App\Repository\LeagueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetTeamsController extends AbstractController
{
    private $leagueRepository;

    private $serializer;

    public function __construct(LeagueRepository $leagueRepository, CollectionSerializer $serializer)
    {
        $this->leagueRepository = $leagueRepository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("leagues/{leagueId}/teams", methods={"GET"})
     */
    public function __invoke(string $leagueId): JsonResponse
    {
        $teams = $this->leagueRepository
            ->find($leagueId)
            ->getTeams();

        return $this->json($this->serializer->toArray($teams));
    }
}
