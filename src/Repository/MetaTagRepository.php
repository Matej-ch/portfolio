<?php

namespace App\Repository;

use App\Entity\MetaTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MetaTag>
 *
 * @method MetaTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaTag[]    findAll()
 * @method MetaTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaTag::class);
    }

    public function add(MetaTag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MetaTag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findForPage($pageName)
    {
        return $this->createQueryBuilder('m')
            ->where('m.pageName = :pageName')
            ->setParameter('pageName', $pageName)
            ->getQuery()
            ->getResult();
    }
}
