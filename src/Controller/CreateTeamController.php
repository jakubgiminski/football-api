<?php declare(strict_types=1);

namespace App\Controller;

use App\Id;
use App\Service\CreateTeam;
use App\Service\ValidateRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTeamController extends AbstractController
{
    private $validateRequest;

    private $createTeam;

    public function __construct(ValidateRequest $validateRequest, CreateTeam $createTeam)
    {
        $this->validateRequest = $validateRequest;
        $this->createTeam = $createTeam;
    }

    /**
     * @Route("leagues/{leagueId}/teams", methods={"POST"})
     */
    public function __invoke(string $leagueId, Request $request): JsonResponse
    {
        ($this->validateRequest)($request, ['id', 'name', 'strip']);

        $team = ($this->createTeam)(
            new Id($leagueId),
            new Id($request->get('id')),
            $request->get('name'),
            $request->get('strip')
        );

        return new JsonResponse($team->toArray(), 201);
    }
}
