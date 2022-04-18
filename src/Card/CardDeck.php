<?php

namespace App\Card;

use App\Card\Card;

class CardDeck
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
    }

    public function drawACard(): ?Card
    {
        if (count($this->deck)) {
            $randomKey = array_rand($this->deck, 1);
            $cardToReturn = $this->deck[$randomKey];
            unset($this->deck[$randomKey]);
            return $cardToReturn;
        }
    }

    public function drawACardAndAddItToHand(int $cardsToDraw = 1): void
    {
        if ($cardsToDraw > count($this->deck)) {
            $cardsToDraw = count($this->deck);
        }
        if (count($this->deck) > 0) {
            $randomKeys = array_rand($this->deck, $cardsToDraw);
            if (is_array($randomKeys)) {
                foreach ($randomKeys as $randomKey) {
                    $this->hand[] = $this->deck[$randomKey];
                    unset($this->deck[$randomKey]);
                }
            } else {
                $this->hand[] = $this->deck[$randomKeys];
                unset($this->deck[$randomKeys]);
            }
        }
    }

    public function getDrawnCardsAsString(): string
    {
        $str = "";
        foreach ($this->hand as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }

    public function getAmountOfCardsInDeck(): int
    {
        return count($this->deck);
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
