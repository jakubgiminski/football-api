<?php declare(strict_types=1);

namespace App\Controller;

use App\Id;
use App\Repository\LeagueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeleteLeagueController extends AbstractController
{
    private $leagueRepository;

    private $objectManager;

    public function __construct(LeagueRepository $leagueRepository, ObjectManager $objectManager)
    {
        $this->leagueRepository= $leagueRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("leagues/{leagueId}", methods={"DELETE"})
     */
    public function __invoke(string $leagueId): JsonResponse
    {
        $league = $this->leagueRepository->findOrFail(new Id($leagueId));

        $this->objectManager->remove($league);
        $this->objectManager->flush();

        return new JsonResponse(null, 200);
    }
}
