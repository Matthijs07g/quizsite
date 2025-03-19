<?php

namespace App\Controller;

use App\Repository\FinaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class FinaleController extends AbstractController
{
    private FinaleRepository $finaleRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(FinaleRepository $finaleRepository, EntityManagerInterface $entityManager)
    {
        $this->finaleRepository = $finaleRepository;
        $this->entityManager = $entityManager;
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
            return $this->json(['error' => 'Finale not found with this id ', $id], 404);
        }

        return $this->json($finale);
    }

    
}