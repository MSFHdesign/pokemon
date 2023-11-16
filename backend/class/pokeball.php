<?php

class Pokeball {
    protected $quantity;
    protected $catchRateMultiplier;
    protected $pokeCoinCost;

    public function __construct($quantity, $catchRateMultiplier, $pokeCoinCost) {
        $this->quantity = $quantity;
        $this->catchRateMultiplier = $catchRateMultiplier;
        $this->pokeCoinCost = $pokeCoinCost;
    }

    public function use() {
        if ($this->quantity > 0) {
            $this->quantity--;
            return $this->tryToCatchPokemon();
        } else {
            return "Out of " . $this->getType() . " Pokéballs!";
        }
    }

    protected function tryToCatchPokemon() {
        $randomNumber = mt_rand(1, 100);
        $catchRate = $this->getBaseCatchRate() * $this->catchRateMultiplier;

        if ($randomNumber <= $catchRate) {
            return "Successfully caught the Pokémon!";
        } else {
            return "Failed to catch the Pokémon!";
        }
    }

    protected function deductPokeCoins() {
        $response = "Deducting {$this->pokeCoinCost} PokéCoins...";
        // Implementer din logik for at trække PokéCoins her
        return $response;
    }

    public function getPokeCoinCost() {
        return $this->pokeCoinCost;
    }

    protected function getBaseCatchRate() {
        return 30;
    }

    protected function getType() {
        return 'Regular';
    }
}
?>
