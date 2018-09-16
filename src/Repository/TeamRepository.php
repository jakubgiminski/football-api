<?php

namespace App\Repository;

use App\Entity\Team;
use App\Id;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class TeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function findOrFail(Id $teamId): Team
    {
        $team = $this->find($teamId);
        if ($team === null) {
            throw new ResourceNotFoundException(Team::class);
        }
        return $team;
    }
}
