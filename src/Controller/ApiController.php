<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/card/api/deck', name: 'api_deck', methods: ['GET'])]
    public function deck(
        SessionInterface $session,

    ): JsonResponse {
        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();

        $data = [
            'data' => ['deck' => $deck->getAsString()],
        ];

        return $this->json($data);
    }
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

    #[Route('/card/api/deck/deal/{players}/{cards}', name: 'api_player', methods: ["GET"])]
    public function players(
        SessionInterface $session,
        int $players = 1,
        int $cards = 1
    ): Response {
        $deck = $session->get("card-hand") ?? new \App\Card\CardDeck();
        $thePlayers = [];
        $stringRepPlayers = [];

        for ($i = 0; $i < $players; $i++) {
            $thePlayers[] = new \App\Card\CardPlayer();
        }
        for ($i = 0; $i < $cards; $i++) {
            foreach ($thePlayers as $player) {
                $player->add($deck->drawACard());
            }
        }
        foreach ($thePlayers as $player) {
            $stringRepPlayers[] = $player->getAsString();
        }

        $data = [
            'controller_name' => 'PlayerController',
            'amount_players' => count($thePlayers),
            'players' => $stringRepPlayers,
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
        ];
        return $this->json($data);
    }
}
