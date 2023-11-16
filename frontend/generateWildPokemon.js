async function generateWildPokemon() {
    let listItem;
    let wildPokemonData;
    let currentHealth;

    try {
        const level = 5;
        const response = await fetch('../backend/api/generateWildPokemon.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                level: level,
            }),
        });

        if (response.ok) {
            wildPokemonData = await response.json();
            const pokemonName = wildPokemonData.name.replace(/\\u(\d{4})/g, (_, code) => String.fromCharCode(parseInt(code, 16)));
            
            const wildPokemonUl = document.getElementById('wildPokemonUl');
            listItem = document.createElement('li');
            listItem.innerHTML = `
            <div class="pokemon-ui">
                <div class="centerAlign">
                    <p>ID: ${wildPokemonData.id}</p>
                    <h2 class="caps">${pokemonName}</h2>
                    <img class="playerpokemonPic" src="/images/${wildPokemonData.image}.png" alt="${wildPokemonData.name}">
                    <p><b>Level: ${wildPokemonData.level}</b></p>
                </div>
                <p>Type: ${wildPokemonData.type}</p>
                <p>Attack: ${wildPokemonData.attack}</p>
                <p>Defence: ${wildPokemonData.defence}</p>
                <div class="wildPokemonContainer"></div>
                <p id="wildPokemonHealth">Health: ${wildPokemonData.health} / ${wildPokemonData.health}</p>
                <p>Attacks: ${wildPokemonData.attacks.map(attack => attack.name).join(', ')}</p>
                <p>Speed: ${wildPokemonData.speed}</p>
                <P> Catch rate: ${wildPokemonData.catch_rate}</P>

                <div class="buttons">
                    <button type="button" id="attackButton">Attack Wild Pokémon</button>
                    <button type="button" id="catchButton">Catch Wild Pokémon</button>
                    <button type="button" id="runButton">Run</button>
                </div>
            </div>
            `;
            wildPokemonUl.appendChild(listItem);
            currentHealth = wildPokemonData.health;
        } else {
            throw new Error('Error: Could not generate a wild Pokémon.');
        }
    } catch (error) {
        console.log(error.message);
    }

    if (listItem) {
        const runButton = listItem.querySelector('#runButton');
        runButton.addEventListener('click', async function () {    
            runAway(listItem);
        });

        const catchButton = listItem.querySelector('#catchButton');
        catchButton.addEventListener('click', async function () {    
            catchPokemon(listItem, wildPokemonData, currentHealth);
        });

        const attackButton = listItem.querySelector('#attackButton');
        attackButton.addEventListener('click', async function () {    
            // Assuming you have an updateHealth function to update currentHealth
            // and reflect the change in the HTML
            performAttack(wildPokemonData, currentHealth);
        });
    }
}


