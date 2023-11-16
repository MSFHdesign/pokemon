<?php

require_once '../Pokeball.php';

class GreatBall extends Pokeball {
    public function __construct($quantity) {
        parent::__construct($quantity, 1.5, 5); // Ændring: 5 PokéCoins omkostning
    }
}
?>
