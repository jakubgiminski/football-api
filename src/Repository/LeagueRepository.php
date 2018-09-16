<?php

namespace App\Repository;

use App\Entity\League;
use App\Id;
use App\ResourceNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LeagueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, League::class);
    }

    public function findOrFail(Id $league): League
    {
        $league = $this->find((string) $league);
        if ($league === null) {
            throw new ResourceNotFoundException(League::class);
        }
        return $league;
    }
}
