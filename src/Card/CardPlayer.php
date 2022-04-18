<?php

namespace App\Card;

use App\Card\Card;

class CardPlayer
{
    private $hand;

    public function add(Card $card): void
    {
        $this->hand[] = $card;
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
