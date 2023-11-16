<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend/style/game.css">
    <title>Pokémon Game</title>
</head>
<body>
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
    <script src="../frontend/game.js"></script>
    <script src="../frontend/generateWildPokemon.js"></script>
</body>
</html>
