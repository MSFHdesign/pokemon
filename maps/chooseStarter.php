<?php
session_start(); // Make sure to start the session before checking session variables

require '../backend/class/player.php';
require '../backend/class/pokemon.php';


// Check if userStatus is set to "newUser"
if (isset($_SESSION['user']) && $_SESSION['userStatus'] === "newUser") {
    // Håndter post-anmodninger
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['startGame'])) {

        // Opret en ny spiller med det indtastede navn
        $player = Player::createNewPlayer($_POST['playerName'], $_POST['selectedPokemon']);

        
        header('Location: /maps/startermap.php');
        if (!$player) {
            echo "Fejl ved oprettelse af spiller.";
        }
    } elseif (isset($_POST['restartGame'])) {
        // Hvis formularen til at genstarte spillet er blevet sendt
        restartGame();
    }
}
?>

    <h1>Choose your starter Pokémon and enter your name to start the game</h1>
    <form method="post" action="">
        <label for="playerName">Player Name:</label>
        <input type="text" id="playerName" name="playerName" required>

        <label for="selectedPokemon">Choose your starter Pokémon:</label>
        <select id="selectedPokemon" name="selectedPokemon" required>
            <option value="1">Bulbasaur</option>
            <option value="4">Charmander</option>
            <option value="7">Squirtle</option>
            <option value="25">Pikachu</option>
        </select>

        <button type="submit" name="startGame">Start Game</button>
    </form>
    <?php 
    if (isset($_SESSION['player'])) {
        // Cast the stored player data back to the Player class
        $player = $_SESSION['player'];
        $playerName = $_SESSION['user'];

    } else {
        // If not, set default or handle accordingly
        $player = null;
    }
    ?>
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
<?php
} else {
    // Redirect the player to another page (replace 'index.php' with the actual page)
    header('Location: /index2.php');
    exit();
}
?>
