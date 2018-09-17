<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Team;
use App\Id;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;

final class UpdateTeam
{
    private $teamRepository;
    
    private $objectManager;

    public function __construct(TeamRepository $teamRepository, ObjectManager $objectManager)
    {
        $this->teamRepository = $teamRepository;
        $this->objectManager = $objectManager;
    }

    public function __invoke(Id $teamId, string $teamName, string $teamStrip): Team
    {
        $team = $this->teamRepository->findOrFail($teamId);

        $team->setName($teamName);
        $team->setStrip($teamStrip);

        $this->objectManager->flush();

        return $team;
    }
}