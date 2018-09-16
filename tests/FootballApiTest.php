<?php declare(strict_types=1);

namespace App\Tests;

use App\Entity\League;
use App\Entity\Team;
use App\Id;
use App\Repository\LeagueRepository;
use App\Repository\TeamRepository;
use Doctrine\Common\Persistence\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

abstract class FootballApiTest extends TestCase
{
    /** @var League */
    protected $league;

    /** @var Team */
    protected $team;

    /** @var ObjectManager */
    protected $objectManager;

    /** @var LeagueRepository */
    protected $leagueRepository;

    /** @var TeamRepository */
    protected $teamRepository;

    public function setUp()
    {
        $this->league = new League(
            new Id('premier-league'),
            'Premier League'
        );

        $this->team = new Team(
            new Id('spurs'),
            'Tottenham Hotspur',
            'white and navy blue'
        );

        $this->team->setLeague($this->league);
        $this->league->addTeam($this->team);

        $this->objectManager = $this->mockObjectManager();
        $this->leagueRepository = $this->mockLeagueRepository();
        $this->teamRepository = $this->mockTeamRepository();
    }

    private function mockObjectManager(): MockObject
    {
        $mock = $this->createMock(ObjectManager::class);
        $mock->method('persist');
        $mock->method('flush');
        return $mock;
    }

    private function mockLeagueRepository(): MockObject
    {
        $mock = $this->createMock(LeagueRepository::class);

        $mock
            ->method('findOrFail')
            ->with($this->league->getId())
            ->willReturn($this->league);

        return $mock;
    }

    private function mockTeamRepository(): MockObject
    {
        $mock = $this->createMock(TeamRepository::class);

        $mock
            ->method('findOrFail')
            ->with($this->team->getId())
            ->willReturn($this->team);

        return $mock;
    }
}