<?php

namespace App\Controller;

use App\Entity\Puzzel;
use App\Repository\PuzzelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PuzzelController extends AbstractController
{
    private PuzzelRepository $puzzelRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PuzzelRepository $puzzelRepository, EntityManagerInterface $entityManager)
    {
        $this->puzzelRepository = $puzzelRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/puzzel/random', name: 'puzzel_random', methods: ['GET'])]
    public function getRandomPuzzel(): JsonResponse
    {
        $question = $this->puzzelRepository->getRandomPuzzel();
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/puzzel', name: 'puzzel_all', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $puzzels = $this->puzzelRepository->findAll();
        return $this->json($puzzels);
    }

    #[Route('/api/puzzel/{id}', name:'puzzel_id', methods: ['GET'])]
    public function getPuzzel(string $id): JsonResponse
    {
        $puzzel = $this->puzzelRepository->find($id);
        
        if (!$puzzel) {
            return $this->json(['error' => 'Puzzel not found'], 404);
        }

        return $this->json($puzzel);
    }

    #[Route('/api/puzzel', name: 'create_puzzel', methods: ['POST'])]
    public function createQuestion(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        $requiredFields = ['thema', 'kenmerk1', 'kenmerk2', 'kenmerk3', 'kenmerk4'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
            return $this->json(['error' => 'Missing required fields'], 400);
            }
        }

        $puzzel = new Puzzel();
        foreach ($requiredFields as $field) {
            $setter = 'set' . ucfirst($field);
            $puzzel->$setter($data[$field]);
        }

        $this->entityManager->persist($puzzel);
        $this->entityManager->flush();

        return $this->json($puzzel, 201);
    }

    #[Route('/api/puzzel/{id}', name: 'update_puzzel', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $puzzel = $this->puzzelRepository->find($id);
        
        if (!$puzzel) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        $fields = ['thema', 'kenmerk1', 'kenmerk2', 'kenmerk3', 'kenmerk4'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $setter = 'set' . ucfirst($field);
                $puzzel->$setter($data[$field]);
            }
        }

        $this->entityManager->flush();

        return $this->json($puzzel);
    }

    #[Route('/api/puzzel/{id}', name: 'delete_puzzel', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $puzzel = $this->puzzelRepository->find($id);
        
        if (!$puzzel) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($puzzel);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
    
}