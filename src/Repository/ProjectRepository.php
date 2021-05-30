<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
    * @return Project[] Returns an array of Project objects
    */
    public function findAllOrderByNewest()
    {
         $qb = $this->createQueryBuilder('p');

        return $this->addIsActiveQueryBuilder($qb)
            ->andWhere('p.createdAt IS NOT NULL')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    private function addIsActiveQueryBuilder(QueryBuilder $qb): QueryBuilder
    {
        return $qb->andWhere('p.isActive = :active')->setParameter('active',0);
    }
}
