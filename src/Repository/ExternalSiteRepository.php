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

    public function findPersonal()
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.isPersonal = :personal')
            ->setParameter('personal',1)
            ->orderBy('e.ordering', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
