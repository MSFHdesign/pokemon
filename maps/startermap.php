<?php
session_start();
spl_autoload_register(function ($class) {
    $classPath = '../backend/class/' . $class . '.php';
    
    if (file_exists($classPath)) {
        include $classPath;
    } else {
        echo "Klassen $class blev ikke fundet.";
    }
});

include '../backend/class/player.php';
include '../backend/class/pokemon.php';

if (isset($_SESSION['player'])) {
    // Cast the stored player data back to the Player class
    $player = $_SESSION['player'];
    $playerName = $_SESSION['user'];
} else {
    // If not, set default or handle accordingly
    $player = null;
}
var_dump($_SESSION['user_id']);
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
var_dump($_SESSION);
echo "<br/>";
echo "<br/>";
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
    <script>
        // Log the player information to the browser console
        console.log("Player Information:", <?php echo $player; ?>);
    </script>

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
