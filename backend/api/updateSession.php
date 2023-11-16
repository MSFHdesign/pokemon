<?php
if ($wildPokemon !== null) {
    $_SESSION['wildPokemons'][] = $wildPokemon;
    setcookie('wildPokemons', json_encode($_SESSION['wildPokemons']), time() + 3600);

    // Tilføj niveauet til Pokémon-data
    $level = $wildPokemon->getLevel();
    $wildPokemonData = [
        'name' => $wildPokemon->name,
        'id' => $wildPokemon->id,
        'image' => $wildPokemon->image,
        'level' => $wildPokemon->getLevel(),  
        'type' => $wildPokemon->type,
        'height' => $wildPokemon->height,
        'weight' => $wildPokemon->weight,
        'health' => $wildPokemon->health,
        'speed' => $wildPokemon->speed,
    ];

    echo json_encode($wildPokemonData);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Could not generate a wild Pokémon.']);
}

?>
