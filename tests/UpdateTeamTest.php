<?php declare(strict_types=1);

namespace App\Tests;

use App\Entity\Team;
use App\Service\UpdateTeam;

class UpdateTeamTest extends FootballApiTest
{
    public function testUpdatesTeam(): void
    {
        $updateTeam = new UpdateTeam($this->teamRepository, $this->objectManager);

        $team = $updateTeam(
            $this->team->getId(),
            'new name',
            'new strip'
        );

        $expectedTeam = new Team($this->team->getId(), 'new name', 'new strip');
        $expectedTeam->setLeague($this->league);

        self::assertEquals($expectedTeam, $team);
    }
}