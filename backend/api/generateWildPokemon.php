<?php
session_start();
require '../class/pokemon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wildPokemon = Pokemon::encounterWildPokemon();

    if ($wildPokemon !== null) {
        $_SESSION['wildPokemons'][] = $wildPokemon;
        // Opret et array med Pokemon-ID og anden relevant information
        $wildPokemonData = [
            'uniqueId' => $wildPokemon->uniqueId,
            'id' => $wildPokemon->id,
            'level' => $wildPokemon->getLevel(),
            'type' => $wildPokemon->type,
            'name' => $wildPokemon->name,
            'image' => $wildPokemon->image,
            'height' => $wildPokemon->height,
            'weight' => $wildPokemon->weight,
            'health' => $wildPokemon->health,
            'attacks' => [], // Initialiser et tomt array til angreb
            'speed' => $wildPokemon->speed,
            'defence' => $wildPokemon->defence,
            'attack' => $wildPokemon->attack,
            'special' => $wildPokemon->special,
            'catch_rate' => $wildPokemon->getCatch_rate(),
            'catch_able' => $wildPokemon->getCatchAble(),
        ];
        
        // Hent angrebene og deres navne fra Pokémon-objektet
        foreach ($wildPokemon->attacks as $attack) {
            $wildPokemonData['attacks'][] = [
                'name' => $attack->getName(),
                'damage' => $attack->getDamage(),
                // Tilføj eventuelle andre attributter fra Attack-objektet, f.eks. skade eller type
            ];
        }

        // Vardump angrebene for at kontrollere data
        $encodedData = json_encode($wildPokemonData);

        if (strlen($encodedData) <= 4096) {
            header('Content-Type: application/json');
            echo $encodedData;
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Data is too large.']);
            exit();
        }
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Could not generate a wild Pokémon.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request.']);
}
