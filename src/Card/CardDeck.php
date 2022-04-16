<?php

namespace App\Card;

use App\Card\Card;

class CardDeck
{
    private $deck = [];
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
    }

    public function roll(): void
    {
        foreach ($this->deck as $card) {
            $card->roll();
        }
    }

    public function getNumberDices(): int
    {
        return count($this->deck);
    }

    public function getAsString(): string
    {
        $str = "";
        foreach ($this->deck as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
        // echo implode(', ', $this->deck);
    }
}
