<?php
session_start();

require_once '../backend/class/player.php';
require_once '../backend/class/pokemon.php';
require_once '../backend/class/attack.php';

// Check if the user is not in the session
if (!isset($_SESSION['user'])) {
    header('Location: /index2.php'); // Replace with the actual path to index2.php
    exit();
}

if (isset($_SESSION['player'])) {
    // Unserialize the player object and cast it to the Player class
    $player = $_SESSION['player'];
    $playerName = $_SESSION['user'];


} else {
    // If not, set default or handle accordingly
    $player = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style/game.css">
    <title>Pokémon Game</title>
</head>
<body>
<?php 

if ($player instanceof Player) {
    echo "Dette er en instans af Player.";
    echo "<br/>";
    echo var_dump($player);
} else {
    echo "Dette er ikke en instans af Player.";
    echo "<br/>";
    echo var_dump($player);
}?>
    <div id="game-area">
        <div id="player"></div>
        <div class="obstacle" style="grid-column: 5 / span 3; grid-row: 5 / span 3;"></div>
        <div class="obstacle" style="grid-column: 3 / span 3; grid-row: 10 / span 3;"></div>
        <div class="obstacle" style="grid-column: 15 / span 3; grid-row: 15 / span 3;"></div>
        <div class="grass" style="grid-column: 4 / span 3; grid-row: 15 / span 3;"></div>
        <div class="grass" style="grid-column: 4 / span 3; grid-row: 1 / span 3;"></div>
    </div>


    <div id="wildPokemonList">
        <h2>Wild Pokémons</h2>
        <ul id="wildPokemonUl">
         
        </ul>
    </div>

    <?php 
    include '../frontend/komponents/logud/logud.php';
    ?>
    <script src="../frontend/game.js"></script>
    <script src="../frontend/generateWildPokemon.js"></script>
    <script src="../frontend/performAttack.js"></script>
    <script src="../frontend/runAway.js"></script>
    <script src="../frontend/catchPokemon.js"></script>
</body>
</html>
