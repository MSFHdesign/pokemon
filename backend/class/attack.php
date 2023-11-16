<?php
class Attack {
    private $name;
    private $damage;
    private $type;



    public function __construct($name, $damage) {
        $this->name = $name;
        $this->damage = $damage;

    }

    public function getName() {
        return $this->name;
    }

    public function getDamage() {
        return $this->damage;
    }
    public function calculateDamage($att, $def) {
        // Implementer logik for skade baseret på Pokémonens niveau og base skade
        // Du kan tilpasse dette efter dine egne regler for skadeberegning
        return (($att->attack - $def->defence) + $this->damage);
    }

    // ATTACK!!
    public function attackPokemon($def, $att) {
        $damage = $this->calculateDamage($att, $def);
        $damage = max(0, $damage);
    
        $def->health -= 1 + $damage;
        return $damage;
    }
    

}

?>