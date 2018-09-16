<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\League;
use App\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class LeagueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, League::class);
    }

    public function findOrFail(Id $leagueId): League
    {
        $league = $this->find($leagueId);
        if ($league === null) {
            throw new ResourceNotFoundException(League::class);
        }
        return $league;
    }
}
