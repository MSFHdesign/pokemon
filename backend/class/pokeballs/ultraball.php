<?php

require_once '../Pokeball.php';

class UltraBall extends Pokeball {
    public function __construct($quantity) {
        parent::__construct($quantity, 2, 10); // Ændring: 10 PokéCoins omkostning
    }
}
?>
