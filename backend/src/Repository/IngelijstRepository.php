<?php

namespace App\Repository;

use App\Entity\Ingelijst;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingelijst>
 */
class IngelijstRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingelijst::class);
    }

    public function getRandomIngelijst(): ?Ingelijst
    {
        // First get the total count of records
        $total = $this->createQueryBuilder('q')
            ->select('COUNT(q.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if ($total === 0) {
            return null;
        }

        // Get a random offset
        $offset = rand(0, $total - 1);

        // Get at the random offset
        $query = $this->createQueryBuilder('q')
            ->setFirstResult($offset)
            ->setMaxResults(1)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
}
