<?php
require_once '../class/attack.php';

if (isset($_SESSION['player'])) {
    $player = $_SESSION['player'];
} else {
    echo "Player session not found";
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
    'wildpokemonOutcome' => $wildOutcome,
    'playerOutcome' => $playerOutcome,
    'newPlayerHealth' => $player->getActivePokemon()[0]
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
