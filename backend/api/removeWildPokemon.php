<?php
session_start();

// Få det vilde Pokemon ID at fjerne (du skal muligvis sende dette som en parameter fra frontend).
$wildPokemonIdToRemove = $_POST['wildPokemonId'];

// Fjern det vilde Pokemon fra sessionen
$wildPokemons = $_SESSION['wildPokemons'];
$wildPokemonIndex = array_search($wildPokemonIdToRemove, array_column($wildPokemons, 'id'));

if ($wildPokemonIndex !== false) {
unset($wildPokemons[$wildPokemonIndex]);
$wildPokemons = array_values($wildPokemons); // Opdater nøglerne i arrayet
}

$_SESSION['wildPokemons'] = $wildPokemons;