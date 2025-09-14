<?php

namespace App\Repository;

use App\Entity\Immeuble;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Immeuble>
 */
class ImmeubleRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Immeuble::class);
  }

  /**
   * Ex: trouver un immeuble par son ID
   */
  public function findOneById(int $id): ?Immeuble
  {
    return $this->find($id);
  }
}
