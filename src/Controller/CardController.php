<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card_home")]
    public function home(): Response
    {
        $die = new \App\Card\Card();
        $data = [
            'title' => 'Card',
            'die_value' => $die->roll(),
            'die_as_string' => $die->getAsString(),
            'link_to_roll' => $this->generateUrl('card-roll', ['numRolls' => 5,]),
        ];
        return $this->render('card/home.html.twig', $data);
    }

    #[Route("/card/roll/{numRolls}", name: "card-roll")]
    public function roll(int $numRolls): Response
    {
        $die = new \App\Card\Card();

        $rolls = [];
        for ($i = 1; $i <= $numRolls; $i++) {
            $die->roll();
            $rolls[] = $die->getAsString();
        }

        $data = [
            'title' => 'Dice rolled many times',
            'numRolls' => $numRolls,
            'rolls' => $rolls,
        ];
        return $this->render('card/roll.html.twig', $data);
    }

    #[Route("/card/deck", name: "card_deck")]
    public function deck(): Response
    {
        $available_suits_names = ["heart", "spade", "diamond", "club",];
        $available_values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();


        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/shuffle", name: "card_deck_shuffle")]
    public function shuffle(): Response
    {
        $available_suits_names = ["heart", "spade", "diamond", "club",];
        $available_values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();
        $deck->shuffleDeck();

        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }
}
