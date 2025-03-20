<?php

namespace App\Repository;

use App\Entity\Finale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Finale>
 */
class FinaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Finale::class);
    }

    public function getRandomFinale(): ?Finale
    {
        // First get the total count of questions
        $total = $this->createQueryBuilder('q')
            ->select('COUNT(q.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if ($total === 0) {
            return null;
        }

        // Get a random offset
        $offset = rand(0, $total - 1);

        // Get the question at the random offset
        $query = $this->createQueryBuilder('q')
            ->setFirstResult($offset)
            ->setMaxResults(1)
            ->getQuery();

        return $query->getOneOrNullResult();
    }
}
