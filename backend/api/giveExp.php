<?php
session_start();

// Tjek om cookien 'wildPokemons' eksisterer
if (isset($_SESSION['player'])) {
    // Hent den aktive Pokémon fra spillerobjektet
    $activePokemon = $_SESSION['player']->getActivePokemon();

    // Hvis den aktive Pokémon eksisterer, og der er modtaget erfaring
    if ($activePokemon && isset($_POST['experienceAmount'])) {
        $experienceAmount = $_POST['experienceAmount'];
        $activePokemon->gainExperience($experienceAmount);
        
        // Send en bekræftelsesmeddelelse tilbage
        echo json_encode(['status' => 'success', 'message' => 'Experience added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Active Pokémon not found or experience not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Player session not found.']);
}
?>
