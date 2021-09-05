<?php

namespace App\Repository;

use App\Entity\ExternalSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExternalSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExternalSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExternalSite[]    findAll()
 * @method ExternalSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExternalSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExternalSite::class);
    }

    // /**
    //  * @return ExternalSite[] Returns an array of ExternalSite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExternalSite
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
