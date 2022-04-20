<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/card/api/deck/shuffle', name: 'api_shuffle', methods: ['POST'])]
    public function index(
        SessionInterface $session,

    ): JsonResponse {
        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();
        $deck->shuffleDeck();

        $session->set("card-hand", $deck);

        return $this->json([
            'data' => ['deck' => $deck->getAsString()],
        ]);
    }

    #[Route('/card/api/deck/draw/{number}', name: 'api_draw', methods: ['POST'])]
    public function drawCards(
        SessionInterface $session,
        int $number = 1
    ): JsonResponse {
        $deck = $session->get("card-hand") ?? new \App\Card\CardDeck();
        if (!$session->get("card-hand")) {
            $deck->populateDeck();
        }
        $deck->drawACardAndAddItToHand($number);

        $session->set("card-hand", $deck);

        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
            'cardsDrawn' => $deck->getDrawnCardsAsString(),
        ];

        return $this->json($data);
    }
}
