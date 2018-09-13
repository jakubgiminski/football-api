<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Team;
use App\ResourceNotFoundException;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;

class UpdateTeam
{
    private $teamRepository;
    
    private $objectManager;

    public function __construct(TeamRepository $teamRepository, ObjectManager $objectManager)
    {
        $this->teamRepository = $teamRepository;
        $this->objectManager = $objectManager;
    }

    public function __invoke(
        string $leagueId,
        string $teamId,
        string $teamName,
        string $teamStrip
    ): void {
        $team = $this->teamRepository->findOneBy([
            'league' => $leagueId,
            'id' => $teamId,
        ]);

        if (!$team) {
            throw new ResourceNotFoundException(Team::class);
        }

        $team->setName($teamName);
        $team->setStrip($teamStrip);

        $this->objectManager->persist($team);
        $this->objectManager->flush();
    }
}