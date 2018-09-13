<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\CreateTeam;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTeamController extends AbstractController
{
    private $createTeam;

    public function __construct(CreateTeam $createTeam)
    {
        $this->createTeam = $createTeam;
    }

    /**
     * @Route("leagues/{leagueId}/teams", name="createTeam", methods={"POST"})
     */
    public function __invoke(string $leagueId, Request $request): JsonResponse
    {
        $this->createTeam->__invoke(
            $leagueId,
            $request->get('id'),
            $request->get('name'),
            $request->get('strip')
        );
        
        return new JsonResponse(null, 201);
    }
}
