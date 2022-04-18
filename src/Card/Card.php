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
    protected array $available_suits = ["♥", "♠", "♦", "♣",];
    protected array $available_suits_names = ["heart", "spade", "diamond", "club",];
    protected array $available_values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];

    /**
     * @throws Exception
     */
    public function __construct(string $value = null, string $suit = null)
    {
        if ($value == 'joker') {
            // TODO: Create a joker card
            $this->value = 'joker';
            $this->suit = '';
        } else {

            if ($value && $suit) {
                if (!in_array($suit, $this->available_suits_names)) {
                    throw new Exception(
                        'Cannot create new Card: You can only choose suit from '
                            . implode(', ', $this->available_suits_names) . '.'
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
    }

    public function roll(): string
    {
        $this->value = $this->available_values[random_int(0, count($this->available_values) - 1)];
        return $this->value;
    }

    public function getAsString(): string
    {
        if (array_key_exists($this->suit, $this->associative_suits)) {
            return "[{$this->value} {$this->associative_suits[$this->suit]}]";
        }
        return "[{$this->value}]";
    }
}
