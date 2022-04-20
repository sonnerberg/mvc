<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    #[Route('/card/deck/deal/{players}/{cards}', name: 'card_player')]
    public function index(
        SessionInterface $session,
        int $players = 1,
        int $cards = 1
    ): Response {
        $deck = $session->get("card-hand") ?? new \App\Card\CardDeck();
        // $players = [];
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

        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
            'amount_players' => count($thePlayers),
            'players' => $stringRepPlayers,
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
        ]);
    }
}
