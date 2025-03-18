<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomQuestionController extends AbstractController
{
    private CustomQuestionRepository $customquestionRepository; //change to custom

    public function __construct(CustomQuestionRepository $customquestionRepository) //change to custom
    {
        $this->customquestionRepository = $customquestionRepository;
    }

    #[Route('/api/custom/369', name: '369_allcustom', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $questions = $this->customquestionRepository->findAll();
        return $this->json($questions);
    }

    #[Route('/api/custom/369/{id}', name:'369_custom', methods: ['GET'])]
    public function getQuestion(string $id): JsonResponse
    {
        $question = $this->customquestionRepository->find($id);
        
        if (!$question) {
            return $this->json(['error' => 'Question not found with this id:', $id], 404);
        }

        return $this->json($question);
    }
}