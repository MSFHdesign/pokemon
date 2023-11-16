<?php
session_start();
require '../class/pokemon.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wildPokemon = Pokemon::encounterWildPokemon();

    if ($wildPokemon !== null) {
        $_SESSION['wildPokemons'][] = $wildPokemon->getId(); // Gem Pokemon-ID i stedet for hele Pokemon-objektet
// VI ER HER!!!!
        // Opret et array med Pokemon-ID og anden relevant information
        $wildPokemonData = [
            'id' => $wildPokemon->id,
            'level' => $wildPokemon->getLevel(),
            'name' => $wildPokemon->name,
            'image' => $wildPokemon->image,
            'type' => $wildPokemon->type,
            'height' => $wildPokemon->height,
            'weight' => $wildPokemon->weight,
            'health' => $wildPokemon->health,
            'attacks' => [], // Initialiser et tomt array til angreb
            'speed' => $wildPokemon->speed,
            'defence' => $wildPokemon->defence,
            'attack' => $wildPokemon->attack,
            'special' => $wildPokemon->special,   
            'catch_rate' => $wildPokemon->getCatch_rate(),
   
                  
        ];
        
        // Hent angrebene og deres navne fra Pokémon-objektet
        foreach ($wildPokemon->attacks as $attack) {
            $wildPokemonData['attacks'][] = [
                'name' => $attack->getName(),
                // Tilføj eventuelle andre attributter fra Attack-objektet, f.eks. skade eller type
            ];
        }

        $encodedData = json_encode($wildPokemonData);

        if (strlen($encodedData) <= 4096) {
          //  setcookie('wildPokemons', $encodedData, time() + 60 * 60 * 24 * 30, $cookieParams['path'], null, true, false);
            header('Content-Type: application/json');
            echo json_encode($wildPokemonData);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Cookie data is too large.']);
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
?>