<?php

namespace App\Repository;

use App\Entity\OpenDeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpenDeur>
 */
class OpenDeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenDeur::class);
    }

    public function getRandomOpenDeur(): ?OpenDeur
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
