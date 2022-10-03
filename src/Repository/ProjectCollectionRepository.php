<?php

namespace App\Repository;

use App\Entity\ProjectCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectCollection>
 *
 * @method ProjectCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectCollection[]    findAll()
 * @method ProjectCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectCollectionRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 12;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectCollection::class);
    }

    public function add(ProjectCollection $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProjectCollection $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getProjectPaginator(string $search = null, int $offset = 0): Paginator
    {
        $queryBuilder = $this
            ->createQueryBuilder('project_collection')
            ->leftJoin('project_collection.project', 'project')
            ->addSelect('project');

        return new Paginator($queryBuilder
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery());
    }

    public function findLanding()
    {
        $qb = $this->createQueryBuilder('p');

        return $qb
            ->where('p.isLanding = :is_landing')
            ->setParameter('is_landing', 1)
            ->getQuery()
            ->getResult();
    }
}
