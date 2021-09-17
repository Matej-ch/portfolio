<?php

namespace App\Repository;

use App\Entity\ProjectState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectState|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectState|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectState[]    findAll()
 * @method ProjectState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectState::class);
    }

    /*
    public function findOneBySomeField($value): ?ProjectState
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
