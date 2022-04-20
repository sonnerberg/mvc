<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/card/api/deck/shuffle', name: 'api_shuffle', methods: ['POST'])]
    public function index(): JsonResponse
    {
        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();
        $deck->shuffleDeck();

        return $this->json([
            'data' => ['deck' => $deck->getAsString()],
        ]);
    }
}
