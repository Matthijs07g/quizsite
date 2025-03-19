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
        $query = $this->createQueryBuilder('q')
        ->orderBy('RAND()')
        ->setMaxResults(1)
        ->getQuery();
    
        // Add these debug lines
        $sql = $query->getSQL();
        dump($sql); // This will show the actual SQL query being executed
        
        $result = $query->getOneOrNullResult();
        dump($result); // This will show what was returned
        
        return $result;
    }
}
