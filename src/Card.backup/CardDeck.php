<?php

namespace App\Card;

use Exception;

use App\Card\Card;

class CardDeck
{
    protected array $available_suits_names =[ "heart", "spade", "diamond", "club", ];
    protected array $available_values =["2","3","4","5","6","7","8","9","10","J","Q","K","A"];
    protected Card $cards;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        // TODO: Create a full deck of cards
//        foreach ($this->available_values as $value) {
//            $this->cards[] = new Card();
//        }
        $this->cards = new Card();
    }

    public function showCards()
    {
        foreach ($this->cards as $card) {
            var_dump($card);
        }
    }
}

$test = new CardDeck();
