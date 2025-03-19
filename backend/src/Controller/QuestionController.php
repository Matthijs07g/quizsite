<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Question;

class QuestionController extends AbstractController
{
    private QuestionRepository $questionRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(QuestionRepository $questionRepository, EntityManagerInterface $entityManager)
    {
        $this->questionRepository = $questionRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/369', name: '369_allquestions', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $questions = $this->questionRepository->findAll();
        return $this->json($questions);
    }

    #[Route('/api/369/{id}', name:'369_question', methods: ['GET'])]
    public function getQuestion(string $id): JsonResponse
    {
        $question = $this->questionRepository->find($id);
        
        if (!$question) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/369/random', name: '369_random_question', methods: ['GET'])]
    public function getRandomQuestion(): JsonResponse
    {
        $question = $this->questionRepository->getRandomQuestion();

        dump($question);
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }



    #[Route('/api/369', name: '369_create_question', methods: ['POST'])]
    public function createQuestion(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        if (!isset($data['vraag']) || !isset($data['antwoord'])) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        $question = new Question();
        $question->setVraag($data['vraag']);
        $question->setAntwoord($data['antwoord']);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $this->json($question, 201);
    }

    #[Route('/api/369/{id}', name: '369_update_question', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $question = $this->questionRepository->find($id);
        
        if (!$question) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        if (isset($data['vraag'])) {
            $question->setVraag($data['vraag']);
        }
        if (isset($data['antwoord'])) {
            $question->setAntwoord($data['antwoord']);
        }

        $this->entityManager->flush();

        return $this->json($question);
    }

    #[Route('/api/369/{id}', name: '369_delete_question', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $question = $this->questionRepository->find($id);
        
        if (!$question) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($question);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
}