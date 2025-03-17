<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
    #[Route('/api/questions', name: 'api_questions')]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Welcome to your new controller!'
        ]);
    }

    #[Route('/api/369', name:'369_question')]
    public function getQuestion(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get 369 question with id ' . $id
        ]);
    }
}