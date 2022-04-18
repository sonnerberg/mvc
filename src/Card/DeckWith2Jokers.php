<?php

namespace App\Card;

use App\Card\Card;

class DeckWith2Jokers extends CardDeck
{
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
        $this->add(new \App\Card\Card("joker"));
        $this->add(new \App\Card\Card("joker"));
    }
}
