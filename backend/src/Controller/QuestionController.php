<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
    private QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
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
            return $this->json(['error' => 'Question not found with this id:', $id], 404);
        }

        return $this->json($question);
    }
}