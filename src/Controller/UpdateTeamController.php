<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\UpdateTeam;
use App\ValidateRequest;
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
    public function __invoke(string $leagueId, string $teamId, Request $request): JsonResponse
    {
        ($this->validateRequest)($request, ['name', 'strip']);

        ($this->updateTeam)(
            $leagueId,
            $teamId,
            $request->get('name'),
            $request->get('strip')
        );

        return new JsonResponse(null, 202);
    }
}
