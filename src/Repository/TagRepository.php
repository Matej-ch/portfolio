<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function findAllActive()
    {
        $qb = $this->createQueryBuilder('t');

        return $this->addIsActiveQueryBuilder($qb)
            ->select('t.name')
            ->orderBy('t.ordering', 'ASC')
            ->getQuery()
            ->getResult();
    }

    private function addIsActiveQueryBuilder(QueryBuilder $qb): QueryBuilder
    {
        return $qb->andWhere('t.isActive = :active')->setParameter('active',1);
    }
}
