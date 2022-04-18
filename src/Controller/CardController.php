<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card_home")]
    public function home(
        SessionInterface $session,
    ): Response {
        $deck = $session->get("card-hand") ?? new \App\Card\CardDeck();
        $data = [
            'title' => 'Card',
            'die_value' => $deck->roll(),
            'die_as_string' => $deck->getAsString(),
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
        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();


        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
            'cardsDrawn' => $deck->getDrawnCardsAsString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/shuffle", name: "card_deck_shuffle")]
    public function shuffle(
        SessionInterface $session,
    ): Response {
        $deck = new \App\Card\CardDeck();
        $deck->populateDeck();
        $deck->shuffleDeck();

        $session->set("card-hand", $deck);

        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
            'cardsDrawn' => $deck->getDrawnCardsAsString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck/draw/{number}", name: "card_deck_draw_one")]
    public function drawACard(
        Request $request,
        SessionInterface $session,
        int $number = 1
    ): Response {
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
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("/card/deck2", name: "card_deck2")]
    public function deckWith2Jokers(): Response
    {
        $deck = new \App\Card\DeckWith2Jokers();
        $deck->populateDeck();

        $data = [
            'title' => 'Card',
            'deck' => $deck->getAsString(),
            'amount_cards' => $deck->getAmountOfCardsInDeck(),
            'cardsDrawn' => $deck->getDrawnCardsAsString(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }
}
