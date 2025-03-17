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

    #[Route('/api/369/{id}', name:'369_question')]
    public function getQuestion(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get 369 question with id ' . $id
        ]);
    }

    #[Route('/api/opendeur/{id}', name:'opendeur_question')]
    public function getOpenDeur(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get OpenDeur question with id ' . $id
        ]);
    }

    #[Route('/api/finale/{id}', name:'finale_question')]
    public function getFinale(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get Finale question with id ' . $id
        ]);
    }

    #[Route('/api/galerij/{id}', name:'galerij_question')]
    public function getGalerij(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get Galerij question with id ' . $id
        ]);
    }

    #[Route('/api/ingelijst/{id}', name:'ingelijst_question')]
    public function getIngelijst(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get Ingelijst question with id ' . $id
        ]);
    }

    #[Route('/api/puzzel/{id}', name:'puzzel_question')]
    public function getPuzzel(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get Puzzel question with id ' . $id
        ]);
    }
}