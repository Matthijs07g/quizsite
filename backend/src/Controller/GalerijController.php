<?php

namespace App\Controller;

use App\Entity\Galerij;
use App\Repository\GalerijRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GalerijController extends AbstractController
{
    private GalerijRepository $galerijRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(GalerijRepository $galerijRepository, EntityManagerInterface $entityManager)
    {
        $this->galerijRepository = $galerijRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/galerij/random', name: 'galerij_random', methods: ['GET'])]
    public function getRandomGalerij(): JsonResponse
    {
        $question = $this->galerijRepository->getRandomGalerij();
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/galerij', name: 'galerij_all', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $galerijs = $this->galerijRepository->findAll();
        return $this->json($galerijs);
    }

    #[Route('/api/galerij/{id}', name:'galerij_id', methods: ['GET'])]
    public function getGalerij(string $id): JsonResponse
    {
        $galerij = $this->galerijRepository->find($id);
        
        if (!$galerij) {
            return $this->json(['error' => 'Galerij not found'], 404);
        }

        return $this->json($galerij);
    }

    #[Route('/api/galerij', name: 'create_galerij', methods: ['POST'])]
    public function createQuestion(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        $requiredFields = ['thema', 'afbeelding1', 'afbeelding2', 'afbeelding3', 'afbeelding4', 'afbeelding5', 'afbeelding6', 'afbeelding7', 'afbeelding8'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
            return $this->json(['error' => 'Missing required fields'], 400);
            }
        }

        $galerij = new Galerij();
        foreach ($requiredFields as $field) {
            $setter = 'set' . ucfirst($field);
            $galerij->$setter($data[$field]);
        }

        $this->entityManager->persist($galerij);
        $this->entityManager->flush();

        return $this->json($galerij, 201);
    }

    #[Route('/api/galerij/{id}', name: 'update_galerij', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $galerij = $this->galerijRepository->find($id);
        
        if (!$galerij) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        $fields = ['thema', 'afbeelding1', 'afbeelding2', 'afbeelding3', 'afbeelding4', 'afbeelding5', 'afbeelding6', 'afbeelding7', 'afbeelding8'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $setter = 'set' . ucfirst($field);
                $galerij->$setter($data[$field]);
            }
        }

        $this->entityManager->flush();

        return $this->json($galerij);
    }

    #[Route('/api/galerij/{id}', name: 'delete_galerij', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $galerij = $this->galerijRepository->find($id);
        
        if (!$galerij) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($galerij);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
    
}