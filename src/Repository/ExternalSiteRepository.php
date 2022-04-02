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
            ->setParameter('personal', 1)
            ->orderBy('e.ordering', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findGithub()
    {
        return $this->createQueryBuilder('e')
            ->select('e.url')
            ->andWhere("e.isPersonal = :personal AND e.name LIKE 'github%' ")
            ->setParameter('personal', 1)
            ->orderBy('e.ordering', 'ASC')
            //->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLinkedin()
    {
        return $this->createQueryBuilder('e')
            ->select('e.url')
            ->andWhere("e.isPersonal = :personal AND e.name LIKE 'linked%'")
            ->setParameter('personal', 1)
            ->orderBy('e.ordering', 'ASC')
            //->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllForFooter()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.ordering', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
