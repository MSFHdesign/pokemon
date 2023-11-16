<?php
session_start(); 
// Gem sessionen og regenerer ID

require 'backend/class/player.php';
require 'backend/class/pokemon.php';

// Funktion til at genstarte spillet
function restartGame() {
    // Nulstil sessionen eller andre nødvendige handlinger
    session_destroy();
    session_start();
    setcookie('player', '', time() - 3600);
}

// Håndter post-anmodninger
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['startGame'])) {
        // Hvis formularen til at starte spillet er blevet sendt
      
        // Opret en ny spiller med det indtastede navn

        $player = Player::createNewPlayer($_POST['playerName'], $_POST['selectedPokemon']);


        
        if (!$player) {
            echo "Fejl ved oprettelse af spiller.";
        }
    } elseif (isset($_POST['restartGame'])) {
        // Hvis formularen til at genstarte spillet er blevet sendt
        restartGame();
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Game</title>
    <link rel="stylesheet" href="frontend/style/game.css">
    <link rel="stylesheet" href="frontend/style/pokemon.css">
</head>
<body>
    <?php if (isset($player) && !empty($player->getActivePokemon())): ?>
        <div class="game-area"></div>
        <div id="player"></div>
        <div class="container">
            <div class="playerInfo">
                <?php $activePokemon = $player->getActivePokemon()[0];
                ?>
               <div class="centerAlign">
                <h1>Welcome <?php echo ucwords($player->getName()); ?>!</h1>
                <h2>Du er lige nu i <?php echo ucwords(str_replace('_', ' ', $player->getLocation())); ?></h2>

            </div>
            <div class="pokemon-ui">
                <div class="centerAlign">
                    <p>Your starter Pokémon's ID: <?php echo $activePokemon->id; ?></p>
                <p class="caps"> <b><?php echo $activePokemon->name; ?></b></p><img class="playerpokemonPic" src="/images/<?php echo $activePokemon->image; ?>.png" alt="<?php echo $activePokemon->name; ?>">
                <h3 id="playerLevel">level: <?php echo $activePokemon->level; ?></h3>
            </div>
                
                <p>Your starter Pokémon's health: <?php echo $activePokemon->health; ?></p>
                <div class="health-bar">
    <?php
    
    $health = $player->getActivePokemon()[0]->getHealth();
    
    $healthPercentage = ($health/ $currentHealth ) * 100;
    $healthClass = '';

    if ($healthPercentage >= 41) {
        $healthClass = 'high';
    } elseif ($healthPercentage >= 15) {
        $healthClass = 'medium';
    } else {
        $healthClass = 'low';
    }
    ?>
    <div class="health-progress <?php echo $healthClass; ?>" style="width: <?php echo $healthPercentage; ?>%;"><p class="textCenter"> <?php echo $activePokemon->health; ?>/<?php echo $activePokemon->health; ?></p></div>
</div>
<div id="playerHealth" class="health-progress">
    <p class="textCenter"><?php echo $activePokemon->health;?></p>
</div>

                <p class='names'>defence: <?php echo $activePokemon->defence; ?></p>
                <p class='names'>Speed: <?php echo $activePokemon->speed; ?></p>
                <p class='names'>type: <?php echo $activePokemon->type; ?></p>
                <p class='names'>attack: <?php echo $activePokemon->attack; ?></p>
                <p class='names'>attacks:</p>
                <ul class="attacks-list">
                    <?php foreach ($activePokemon->getAttacks() as $attack): ?>
                        <li>Attack name: <?php echo $attack->getName(); ?></li>
                    <?php endforeach; ?>
                </ul>

                <p> Du har: <?php echo $player->getPokeCoins();?>  Pokecoins</p>

                <h2>Your Pokémon in the computer:</h2>
                <?php if (isset($player) && !empty($player->getPokemonInComputer())): ?>
                    <ul class="computer-pokemon-list">
                        <?php foreach ($player->getPokemonInComputer() as $pokemon): ?>
                            <li><?php echo $pokemon->name; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No Pokémon in the computer.</p>
                <?php endif; ?>
            </div>
            </div>
            <div id="wildPokemonList">
                <h2>Wild Pokémons</h2>
                <ul id="wildPokemonUl"></ul>
            </div>

        </div>
            <form method="post" action="" id="generateWildPokemonForm">
                <button type="button" onclick="generateWildPokemon()">Generate Wild Pokémon</button>
            </form>

        <form method="post" action="">
            <button type="submit" name="restartGame">Restart Game</button>
        </form>

    <?php else: ?>
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
    <?php endif; ?>

    <script src="/frontend/generateWildPokemon.js"></script>
    <script src="/frontend/performAttack.js"></script>
    <script src="/frontend/runAway.js"></script>
    <script src="/frontend/catchPokemon.js"></script>
</body>
</html>