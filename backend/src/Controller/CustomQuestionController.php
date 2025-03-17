<?php

namespace App\Controller\Custom;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomQuestionController extends AbstractController
{
    #[Route('/api/custom/questions', name: 'api_custom_questions')]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Welcome to your new custom controller!'
        ]);
    }

    #[Route('/api/custom/369/{id}', name:'custom_369_question')]
    public function getQuestion(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom 369 question with id ' . $id
        ]);
    }

    #[Route('/api/custom/opendeur/{id}', name:'custom_opendeur_question')]
    public function getOpenDeur(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom OpenDeur question with id ' . $id
        ]);
    }

    #[Route('/api/custom/finale/{id}', name:'custom_finale_question')]
    public function getFinale(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom Finale question with id ' . $id
        ]);
    }

    #[Route('/api/custom/galerij/{id}', name:'custom_galerij_question')]
    public function getGalerij(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom Galerij question with id ' . $id
        ]);
    }

    #[Route('/api/custom/ingelijst/{id}', name:'custom_ingelijst_question')]
    public function getIngelijst(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom Ingelijst question with id ' . $id
        ]);
    }

    #[Route('/api/custom/puzzel/{id}', name:'custom_puzzel_question')]
    public function getPuzzel(string $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Get custom Puzzel question with id ' . $id
        ]);
    }
}