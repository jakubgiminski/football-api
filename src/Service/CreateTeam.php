<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\League;
use App\Entity\Team;
use App\ResourceAlreadyExistsException;
use App\ResourceNotFoundException;
use App\Repository\LeagueRepository;
use App\Repository\TeamRepository;
use App\ValidateId;
use Doctrine\Common\Persistence\ObjectManager;

class CreateTeam
{
    private $leagueRepository;
    
    private $teamRepository;
    
    private $objectManager;

    private $validateId;
    
    public function __construct(
        LeagueRepository $leagueRepository, 
        TeamRepository $teamRepository,
        ObjectManager $objectManager,
        ValidateId $validateId
    ) {
        $this->leagueRepository = $leagueRepository;
        $this->teamRepository = $teamRepository;
        $this->objectManager = $objectManager;
        $this->validateId = $validateId;
    }

    public function __invoke(
        string $leagueId,
        string $teamId, 
        string $teamName, 
        string $teamStrip
    ): void {
        $league = $this->leagueRepository->findOneBy(['id' => $leagueId]);
        if (!$leagueId) {
            throw new ResourceNotFoundException(League::class);
        }

        if ($this->teamRepository->findOneBy(['id' => $teamId])) {
            throw new ResourceAlreadyExistsException(Team::class);
        }

        ($this->validateId)($teamId);

        $team = new Team($teamId, $teamName, $teamStrip);
        $league->addTeam($team);

        $this->objectManager->persist($team);
        $this->objectManager->persist($league);

        $this->objectManager->flush();
    }
}