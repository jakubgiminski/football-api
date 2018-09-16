<?php declare(strict_types=1);

namespace App\Controller;

use App\Id;
use App\Service\UpdateTeam;
use App\Service\ValidateRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateTeamController extends AbstractController
{
    private $validateRequest;

    private $updateTeam;

    public function __construct(ValidateRequest $validateRequest, UpdateTeam $updateTeam)
    {
        $this->validateRequest = $validateRequest;
        $this->updateTeam = $updateTeam;
    }

    /**
     * @Route("leagues/{leagueId}/teams/{teamId}", methods={"PUT"})
     */
    public function __invoke(string $teamId, Request $request): JsonResponse
    {
        ($this->validateRequest)($request, ['name', 'strip']);

        $team = ($this->updateTeam)(
            new Id($teamId),
            $request->get('name'),
            $request->get('strip')
        );

        return new JsonResponse($team->toArray(), 202);
    }
}
