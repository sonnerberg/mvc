<?php

namespace App\Card;

use App\Card\Card;

class DeckWith2Jokers extends CardDeck
{
    private $deck = [];
    private $hand = [];
    private $available_suits_names = ["heart", "spade", "diamond", "club",];
    private $available_values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    public function add(Card $card): void
    {
        $this->deck[] = $card;
    }

    public function populateDeck(): void
    {
        foreach ($this->available_suits_names as $available_suits_name) {
            foreach ($this->available_values as $value) {
                $this->add(new \App\Card\Card($value, $available_suits_name));
            }
        }
        // TODO: Add two jokers
        $this->add(new \App\Card\Card("Joker"));
    }
}
