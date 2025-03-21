<?php

namespace App\Controller;

use App\Entity\OpenDeur;
use App\Repository\OpenDeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OpenDeurController extends AbstractController
{
    private OpenDeurRepository $opendeurRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(OpenDeurRepository $opendeurRepository, EntityManagerInterface $entityManager)
    {
        $this->opendeurRepository = $opendeurRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/opendeur/random', name: 'opendeur_random', methods: ['GET'])]
    public function getRandomOpenDeur(): JsonResponse
    {
        $question = $this->opendeurRepository->getRandomOpenDeur();
        
        if (!$question) {
            return $this->json(['error' => 'No questions found'], 404);
        }

        return $this->json($question);
    }

    #[Route('/api/opendeur', name: 'opendeur_all', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $opendeurs = $this->opendeurRepository->findAll();
        return $this->json($opendeurs);
    }

    #[Route('/api/opendeur/{id}', name:'opendeur_id', methods: ['GET'])]
    public function getOpenDeur(string $id): JsonResponse
    {
        $opendeur = $this->opendeurRepository->find($id);
        
        if (!$opendeur) {
            return $this->json(['error' => 'OpenDeur not found'], 404);
        }

        return $this->json($opendeur);
    }

    #[Route('/api/opendeur', name: 'create_opendeur', methods: ['POST'])]
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

        $opendeur = new OpenDeur();
        foreach ($requiredFields as $field) {
            $setter = 'set' . ucfirst($field);
            $opendeur->$setter($data[$field]);
        }

        $this->entityManager->persist($opendeur);
        $this->entityManager->flush();

        return $this->json($opendeur, 201);
    }

    #[Route('/api/opendeur/{id}', name: 'update_opendeur', methods: ['PUT'])]
    public function updateQuestion(string $id, Request $request): JsonResponse
    {
        $opendeur = $this->opendeurRepository->find($id);
        
        if (!$opendeur) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // Update only provided fields
        $fields = ['thema', 'kenmerk1', 'kenmerk2', 'kenmerk3', 'kenmerk4'];
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $setter = 'set' . ucfirst($field);
                $opendeur->$setter($data[$field]);
            }
        }

        $this->entityManager->flush();

        return $this->json($opendeur);
    }

    #[Route('/api/opendeur/{id}', name: 'delete_opendeur', methods: ['DELETE'])]
    public function deleteQuestion(string $id): JsonResponse
    {
        $opendeur = $this->opendeurRepository->find($id);
        
        if (!$opendeur) {
            return $this->json(['error' => 'Question not found'], 404);
        }

        $this->entityManager->remove($opendeur);
        $this->entityManager->flush();

        return $this->json(null, 204);
    }
    
}