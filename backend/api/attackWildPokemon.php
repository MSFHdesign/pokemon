<?php
require_once '../class/attack.php';
require_once '../class/player.php';
require_once '../class/pokemon.php';
session_start();
if (isset($_SESSION['player'])) {
    $player = $_SESSION['player'];
    session_regenerate_id(true);
    // Hent den aktive Pokemon
   
     $getActivePokemon = $player;

    // Tjek, om $getActivePokemon indeholder det forventede

    if ($getActivePokemon instanceof player) {
        echo "Dette er en instans af player.";
    } else {
        echo "Dette er ikke en instans af Pokemon.";
    }
    echo "<br/>";
    // Send dataen som JSON
    echo json_encode($getActivePokemon);
    echo "<br/> <br/>";
} else {
    echo "Player session not found";
}


if (isset($_SESSION['wildPokemons'])) {
    echo "<br/>";
    $wildPokemons = $_SESSION['wildPokemons'];

    // Udskriv Pokemon-data og angrebene som JSON
    foreach ($wildPokemons as $pokemon) {
        if ($pokemon instanceof Pokemon) {
            echo "<br/>";
            echo "Dette er en instans af Pokemon.";

        } else {
            echo "Dette er ikke en instans af Pokemon.";
        }
        $pokemonData = [
            'uniqueId' => $pokemon->uniqueId,
            'id' => $pokemon->id,
            'level' => $pokemon->getLevel(),
            'type' => $pokemon->type,
            'name' => $pokemon->name,
            'image' => $pokemon->image,
            'height' => $pokemon->height,
            'weight' => $pokemon->weight,
            'health' => $pokemon->health,
            'attacks' => $pokemon->attacks, // Her beholder vi angrebene som objekter
            'speed' => $pokemon->speed,
            'defence' => $pokemon->defence,
            'attack' => $pokemon->attack,
            'special' => $pokemon->special,
            'catch_rate' => $pokemon->getCatch_rate(),
            'catch_able' => $pokemon->getCatchAble(),
        ];

        // Konverter angrebene fra objekter til arrays
        foreach ($pokemon->attacks as $attack) {
            $pokemonData['attacks'][] = [
                'name' => $attack->getName(),
                'damage' => $attack->getDamage(),
            ];

        }
       

        echo "<br/>";
        echo "<pre>";
        echo json_encode($pokemonData);
        echo "</pre>";
    }
} else {
    echo "wildPokemons session not found";
}
// Håndter POST-anmodningen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dekod JSON-data fra anmodningen
    $requestData = json_decode(file_get_contents('php://input'));

    // Tjek om nødvendige felter er tilgængelige
    if (isset($requestData->defender) && isset($requestData->attacker)) {
        // Modtaget data
        $wildPokemon = $requestData->defender->pokemonData;
    

        // attacker info:
        $att = $requestData->attacker->pokemonData;


        $attbonus = 0;
        // Opret en instans af Attack-objektet
        $attackInstance = new Attack("test", $attbonus);
// Udfør angrebet fra player-pokemon til wild-pokemon

$wildOutcome = $attackInstance->attackPokemon($wildPokemon, $att);

// Udfør angrebet fra wild-pokemon til player-pokemon
$playerOutcome = $attackInstance->attackPokemon($att, $wildPokemon);

// Hån
// Håndter 'aliveStatus' baseret på resultatet af det sidste angreb


// Returner testdata
echo json_encode([
    'message' => 'TestData received successfully!',
]);


    } else {
        // Håndter fejl hvis nødvendige felter mangler
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Missing required fields']);
    }
} else {
    // Håndter fejl hvis anmodning ikke er en POST-anmodning
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed']);
}
?>
