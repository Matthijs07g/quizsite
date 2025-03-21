<?php

namespace App\Controller;

use App\Entity\Ingelijst;
use App\Repository\IngelijstRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class IngelijstController extends AbstractController
{
    private IngelijstRepository $ingelijstRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(IngelijstRepository $ingelijstRepository, EntityManagerInterface $entityManager)
    {
        $this->ingelijstRepository = $ingelijstRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/ingelijst/random', name: 'ingelijst_random', methods: ['GET'])]
    public function getRandomIngelijst(): JsonResponse
    {
        $question = $this->ingelijstRepository->getRandomIngelijst();
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/ingelijst', name: 'ingelijst_all', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $ingelijsts = $this->ingelijstRepository->findAll();
        return $this->json($ingelijsts);
    }

    #[Route('/api/ingelijst/{id}', name:'ingelijst_id', methods: ['GET'])]
    public function getIngelijst(string $id): JsonResponse
    {
        $ingelijst = $this->ingelijstRepository->find($id);
        
        if (!$ingelijst) {
            return $this->json(['error' => 'Ingelijst not found'], 404);
        }

        return $this->json($ingelijst);
    }

    #[Route('/api/ingelijst', name: 'create_ingelijst', methods: ['POST'])]
    public function createQuestion(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        $requiredFields = ['thema', 'antwoord1', 'antwoord2', 'antwoord3', 'antwoord4', 'antwoord5', 'antwoord6', 'antwoord7', 'antwoord8', 'antwoord9', 'antwoord10'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
            return $this->json(['error' => 'Missing required fields'], 400);
            }
        }

        $ingelijst = new Ingelijst();
        foreach ($requiredFields as $field) {
            $setter = 'set' . ucfirst($field);
            $ingelijst->$setter($data[$field]);
        }

        $this->entityManager->persist($ingelijst);
        $this->entityManager->flush();

        return $this->json($ingelijst, 201);
    }

    #[Route('/api/ingelijst/{id}', name: 'update_ingelijst', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $ingelijst = $this->ingelijstRepository->find($id);
        
        if (!$ingelijst) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        $fields = ['thema', 'antwoord1', 'antwoord2', 'antwoord3', 'antwoord4', 'antwoord5', 'antwoord6', 'antwoord7', 'antwoord8', 'antwoord9', 'antwoord10'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $setter = 'set' . ucfirst($field);
                $ingelijst->$setter($data[$field]);
            }
        }

        $this->entityManager->flush();

        return $this->json($ingelijst);
    }

    #[Route('/api/ingelijst/{id}', name: 'delete_ingelijst', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $ingelijst = $this->ingelijstRepository->find($id);
        
        if (!$ingelijst) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($ingelijst);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
    
}