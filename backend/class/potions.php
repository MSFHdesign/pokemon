<?php

class Potion {
    private $quantity;

    public function __construct($quantity) {
        $this->quantity = $quantity;
    }

    public function use() {
        if ($this->quantity > 0) {
            $this->quantity--;
            return "Used a potion. Remaining: " . $this->quantity;
        } else {
            return "Out of potions!";
        }
    }
}
?>
