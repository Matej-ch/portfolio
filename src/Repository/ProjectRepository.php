<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 10;

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
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->getQuery()
            ->getResult();
    }

    private function addIsActiveQueryBuilder(QueryBuilder $qb): QueryBuilder
    {
        return $qb->andWhere('p.isActive = :active')->setParameter('active', 1);
    }

    public function getProjectPaginator(string $search = null, int $offset = 0): Paginator
    {
        $queryBuilder = $this
            ->createQueryBuilder('project')
            ->orderBy('project.createdAt', 'DESC')
            ->leftJoin('project.tags', 'tag')
            ->addSelect('tag')
            ->leftJoin('project.language', 'language')
            ->addSelect('language');

        if ($search) {
            $queryBuilder
                ->andWhere('project.name LIKE :searchTerm OR project.description LIKE :searchTerm OR tag.name LIKE :searchTerm OR language.name LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $search . '%');
        }

        return new Paginator($queryBuilder
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery());
    }
    
    public function findRandom()
    {
        $qb = $this->createQueryBuilder('p');

        $projectIDs = $this->addIsActiveQueryBuilder($qb)
            ->select('p.id')
            ->getQuery()->getSingleColumnResult();

        shuffle($projectIDs);

        $qb1 = $this->createQueryBuilder('p');
        return $this->addIsActiveQueryBuilder($qb1)
            ->andWhere('p.id IN (:ids)')
            ->setParameter('ids', array_slice($projectIDs, 0, 15))
            ->setMaxResults(15)
            ->getQuery()
            ->getResult();
    }
}
