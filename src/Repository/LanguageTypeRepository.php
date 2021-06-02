<?php

namespace App\Repository;

use App\Entity\LanguageType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LanguageType|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageType|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageType[]    findAll()
 * @method LanguageType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageType::class);
    }

    // /**
    //  * @return LanguageType[] Returns an array of LanguageType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LanguageType
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
