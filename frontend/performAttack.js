async function performAttack(wildPokemonData) {
    try {
        // Hent spillerdata fra din API-endpoint
        const playerResponse = await fetch('../backend/api/getPlayerInfo.php');
        
        // Kontroller, om anmodningen var vellykket (statuskode 200)
        if (playerResponse.ok) {
            // Hent JSON-data fra svaret
            const playerData = await playerResponse.json();

            // Lav en HTTP POST-anmodning til dit API med spilleren som angriberen
            const response = await fetch('../backend/api/attackWildPokemon.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    defender: {
                        pokemonData: wildPokemonData,
                    },
                    attacker: {
                        pokemonData: playerData.activePokemon[0],
                    },
                }),
                
            });

            // Kontroller, om anmodningen var vellykket (statuskode 200)
            if (response.ok) {
                
                // Hent JSON-data fra svaret
                const responseData = await response.json();
            
                // Hent den indledende sundhed og skaden fra JSON-svaret
                const initialPlayerHealth = playerData.activePokemon[0].health;
                const damageTaken = responseData.wildpokemonOutcome;
            
                // Udskriv værdierne i konsollen for at fejlfinde
                console.log('Initial Player Health:', initialPlayerHealth);
                console.log('Damage Taken:', damageTaken);
            
                // Kontroller om værdierne er numeriske
                if (!isNaN(initialPlayerHealth) && !isNaN(damageTaken)) {
                    // Opdater Pokémon-helbredet på brugergrænsefladen
                    const playerHealthElement = document.getElementById('playerHealth');
                    
                    // Beregn den nye sundhedsværdi efter skaden er trukket fra
                    const newHealth = Math.max(0, initialPlayerHealth - damageTaken);
                    
                    // Opdater brugergrænsefladen med det nye helbred
                    playerHealthElement.style.width = `${(newHealth / initialPlayerHealth) * 100}%`;
                    playerHealthElement.innerHTML = `<p class="textCenter">${newHealth} HP</p>`;
                } else {
                    console.error('Invalid numeric values received.');
                }
            } else {
                // Håndter fejl - f.eks. vis en fejlmeddelelse til brugeren
                console.error('Error:', response.statusText);
            }
            
            
}
    } catch (error) {}}
// Kald funktionen for at udføre angrebet

