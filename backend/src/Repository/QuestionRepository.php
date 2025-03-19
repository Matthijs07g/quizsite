<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Question>
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function bulkCreate(array $questions): array
    {
        $entityManager = $this->getEntityManager();
        $createdQuestions = [];

        try {
            $entityManager->beginTransaction();

            foreach ($questions as $questionData) {
                $question = new Question();
                $question->setVraag($questionData['vraag']);
                $question->setAntwoord($questionData['antwoord']);

                $entityManager->persist($question);
                $createdQuestions[] = $question;
            }

            $entityManager->flush();
            $entityManager->commit();

            return $createdQuestions;
        } catch (\Exception $e) {
            $entityManager->rollback();
            throw $e;
        }
    }

    public function getRandomQuestion(): ?Question
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
