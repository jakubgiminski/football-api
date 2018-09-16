<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Team;
use App\Id;
use App\Exception\ResourceAlreadyExistsException;
use App\Repository\LeagueRepository;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;

final class CreateTeam
{
    private $leagueRepository;
    
    private $teamRepository;
    
    private $objectManager;

    public function __construct(
        LeagueRepository $leagueRepository, 
        TeamRepository $teamRepository,
        ObjectManager $objectManager
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->teamRepository = $teamRepository;
        $this->objectManager = $objectManager;
    }

    public function __invoke(Id $leagueId, Id $teamId, string $teamName, string $teamStrip): Team
    {
        $league = $this->leagueRepository->findOrFail($leagueId);

        if ($this->teamRepository->exists($teamId)) {
            throw new ResourceAlreadyExistsException(Team::class);
        }

        $team = new Team($teamId, $teamName, $teamStrip);
        $this->objectManager->persist($team);

        $league->addTeam($team);
        $this->objectManager->persist($league);

        $this->objectManager->flush();

        return $team;
    }
}