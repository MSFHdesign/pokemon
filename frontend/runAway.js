async function runAway(listItem) {
    try {
        // Implement the logic for running away from the wild Pokémon here.
        // You might want to include some randomness to determine the success of running away.
        const success = Math.random() > 0.5; // Example: 50% chance of success

        if (success) {
            console.log('Successfully ran away from the wild Pokémon!');
            
            // Remove the wild Pokémon from the list
            const wildPokemonUl = document.getElementById('wildPokemonUl');

            if (listItem) {
                wildPokemonUl.removeChild(listItem);
            }
        } else {
            console.log('Failed to run away. You are still in battle!');
            console.log('ATTACK! player should take damage from the wild pokemon')
        }
    } catch (error) {
        console.error('Error while attempting to run away:', error.message);
    }
}
