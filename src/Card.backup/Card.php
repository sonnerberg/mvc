<?php

namespace App\Card;

use Exception;

class Card
{
    protected string $value;
    protected string $suit;
    protected array $associative_suits = [
        "heart" => "♥",
        "spade" => "♠",
        "diamond" => "♦",
        "club" => "♣",
        ];
    protected array $available_suits =[ "♥", "♠", "♦", "♣", ];
    protected array $available_suits_names =[ "heart", "spade", "diamond", "club", ];
    protected array $available_values =["2","3","4","5","6","7","8","9","10","J","Q","K","A"];

    /**
     * @throws Exception
     */
    public function __construct(string $value = null, string $suit = null)
    {
        if ($value && $suit) {
            if (!in_array($suit, $this->available_suits_names)) {
                throw new Exception(
                    'Cannot create new Card: You can only choose suit from '
                    .implode(', ', $this->available_suits_names).'.'
                );
            }
            $this->value = $value;
            $this->suit = $suit;
        } else {
            $this->value =
                $this->available_values[random_int(0, count($this->available_values) - 1)];
            $this->suit  =
                $this->available_suits_names[random_int(0, count($this->available_suits_names) - 1)];
        }
    }

    public function getAsString(): string
    {
        return "[{$this->value} {$this->associative_suits[$this->suit]}]";
    }
}

//$test = new Card('2', 'heart');
//$test = new Card();
//var_dump($test->getAsString());
