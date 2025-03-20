<?php

namespace App\Controller;

use App\Entity\Finale;
use App\Repository\FinaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FinaleController extends AbstractController
{
    private FinaleRepository $finaleRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(FinaleRepository $finaleRepository, EntityManagerInterface $entityManager)
    {
        $this->finaleRepository = $finaleRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/finale/random', name: 'finale_random', methods: ['GET'])]
    public function getRandomFinale(): JsonResponse
    {
        $question = $this->finaleRepository->getRandomFinale();
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/finale', name: 'finale_all', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $finales = $this->finaleRepository->findAll();
        return $this->json($finales);
    }

    #[Route('/api/finale/{id}', name:'finale_id', methods: ['GET'])]
    public function getFinale(string $id): JsonResponse
    {
        $finale = $this->finaleRepository->find($id);
        
        if (!$finale) {
            return $this->json(['error' => 'Finale not found'], 404);
        }

        return $this->json($finale);
    }

    #[Route('/api/finale', name: 'create_finale', methods: ['POST'])]
    public function createQuestion(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        $requiredFields = ['thema', 'kenmerk1', 'kenmerk2', 'kenmerk3', 'kenmerk4', 'kenmerk5'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
            return $this->json(['error' => 'Missing required fields'], 400);
            }
        }

        $finale = new Finale();
        foreach ($requiredFields as $field) {
            $setter = 'set' . ucfirst($field);
            $finale->$setter($data[$field]);
        }

        $this->entityManager->persist($finale);
        $this->entityManager->flush();

        return $this->json($finale, 201);
    }

    #[Route('/api/finale/{id}', name: 'update_finale', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $finale = $this->finaleRepository->find($id);
        
        if (!$finale) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        $fields = ['thema', 'kenmerk1', 'kenmerk2', 'kenmerk3', 'kenmerk4', 'kenmerk5'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
            $setter = 'set' . ucfirst($field);
            $finale->$setter($data[$field]);
            }
        }

        $this->entityManager->flush();

        return $this->json($finale);
    }

    #[Route('/api/finale/{id}', name: 'delete_finale', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $finale = $this->finaleRepository->find($id);
        
        if (!$finale) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($finale);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
    
}