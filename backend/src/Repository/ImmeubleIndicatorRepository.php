<?php

namespace App\Repository;

use App\Entity\ImmeubleIndicator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImmeubleIndicator>
 */
class ImmeubleIndicatorRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, ImmeubleIndicator::class);
  }

  /**
   * Ex: récupérer tous les indicateurs d’un immeuble
   */
  public function findByImmeubleId(int $immeubleId): array
  {
    return $this->createQueryBuilder('i')
      ->andWhere('i.immeuble = :immeubleId')
      ->setParameter('immeubleId', $immeubleId)
      ->orderBy('i.updatedAt', 'DESC')
      ->getQuery()
      ->getResult();
  }
}
