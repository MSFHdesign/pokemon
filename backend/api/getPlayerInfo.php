<?php
require_once "../class/player.php";
require_once "../class/pokemon.php";

// Opret en ny instans af Player-klassen
session_start();

// Tjek, om sessionen indeholder den forventede player


// Hvis sessionen indeholder en spiller
if (isset($_SESSION['player'])) {
    $player = $_SESSION['player'];
    session_regenerate_id(true);
    // Hent den aktive Pokemon
    $getActivePokemon = $player->getActivePokemonWithMoves();
    // $getActivePokemon = $player->getActivePokemon();

    // Tjek, om $getActivePokemon indeholder det forventede


    // Send dataen som JSON
    echo json_encode($getActivePokemon);
} else {
    echo "Player session not found";
}
?>
