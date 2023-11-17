async function catchPokemon(listItem, wildPokemonData, currentHealth) {
    try {
        const maxCatchRate = 300; // Maksimal catch_rate-værdi
        const minSuccessRate = 0.001; // Minimum chance for at fange.
        let currentHP = currentHealth; 
        const maxHp = wildPokemonData.health;
        lostHP = maxHp - currentHP;
        percentHP = lostHP / maxHp; 
        // Antag, at catch_rate er en værdi mellem 1 og 300
        const catch_rate = wildPokemonData.catch_rate;

        // Juster catch_rate til en chance mellem minSuccessRate og 1
        const successRate = catch_rate / maxCatchRate + (1 - catch_rate / maxCatchRate) * minSuccessRate;

        // Generer en tilfældig værdi mellem 0 og 1
        const randomValue = Math.round(Math.random() * 1000) / 1000;

        // Bestem catch success baseret på den tilfældige værdi og successRate
        const catchSuccess = randomValue < successRate;

        // Udskriv resultaterne til konsollen
        console.log("Catch Rate:", catch_rate);
        console.log("Success Rate:", successRate);
        console.log("Random Value:", randomValue);
        console.log("Catch Success:", catchSuccess);
        console.log("percentHP", percentHP);

        
        console.log("id", wildPokemonData.name);
        if (catchSuccess) {
            console.log('Successfully caught the wild Pokémon!');

            // Remove the wild Pokémon from the list
            const wildPokemonUl = document.getElementById('wildPokemonUl');
            if (listItem) {
                wildPokemonUl.removeChild(listItem);
            }

            // Send the caught Pokémon to the player's active Pokémon
            // add Logic to add pokemon to players computer or active pokemons.
            // const response = await fetch('../backend/api/addPokemonToPlayer.php', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify({
            //         pokemonData: wildPokemonData,
            //     }),
            // });
        } else {
            console.log('Failed to catch the wild Pokémon. It escaped!');

            // Implement any additional logic or UI updates if the catch is not successful.
        }
    } catch (error) {
        console.error('Error while attempting to catch the wild Pokémon:', error.message);
    }
}
