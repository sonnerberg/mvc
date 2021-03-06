<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function roll(): void
    {
        foreach ($this->hand as $card) {
            $card->roll();
        }
    }

    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    public function getAsString(): string
    {
        $str = "";
        foreach ($this->hand as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }
}
