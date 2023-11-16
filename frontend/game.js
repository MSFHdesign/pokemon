document.addEventListener('DOMContentLoaded', function () {
    const player = document.getElementById('player');
    const gameArea = document.getElementById('game-area');
    const obstacles = document.querySelectorAll('.obstacle');
    const grassElements = document.querySelectorAll('.grass'); // Ændret til querySelectorAll

    const speed = 5;

    window.addEventListener('keydown', async function (event) {
        let newTop = player.offsetTop;
        let newLeft = player.offsetLeft;

        switch (event.key) {
            case 'ArrowUp':
                newTop -= speed;
                break;
            case 'ArrowDown':
                newTop += speed;
                break;
            case 'ArrowLeft':
                newLeft -= speed;
                break;
            case 'ArrowRight':
                newLeft += speed;
                break;
            default:
                return; // Exit function for non-arrow keys
        }

        // Check if the new position is within the game area and not overlapping with obstacles
        if (
            (newTop >= 0 && newTop + player.offsetHeight <= gameArea.offsetHeight) &&
            (newLeft >= 0 && newLeft + player.offsetWidth <= gameArea.offsetWidth) &&
            !isCollidingWithObstacle(newTop, newLeft)
        ) {
            player.style.top = `${newTop}px`;
            player.style.left = `${newLeft}px`;

            // Check if the player is in any of the grass elements
            for (const grass of grassElements) {
                if (isInGrass(player, grass)) {
                    console.log('Player is in the grass!');
                    const randomChance = Math.random();

                    // Bestem chancen for at udløse funktionen (f.eks. 5% chance)
                    const chanceThreshold = 0.05;

                    // Check om det tilfældige tal er inden for chancen
                    if (randomChance < chanceThreshold) {
                        console.log('Generating wild Pokémon!');

                        // Call the function to generate a wild Pokémon
                        await generateWildPokemon();
                    }
                    // Add additional logic or actions if the player is in the grass
                }
            }
        }
    });

    function isCollidingWithObstacle(top, left) {
        // Check if the player collides with any obstacle
        for (const obstacle of obstacles) {
            const obstacleRect = obstacle.getBoundingClientRect();
            const playerRect = player.getBoundingClientRect();

            if (
                top < obstacleRect.bottom &&
                top + playerRect.height > obstacleRect.top &&
                left < obstacleRect.right &&
                left + playerRect.width > obstacleRect.left
            ) {
                return true; // Collision detected
            }
        }
        return false; // No collision
    }

    function isInGrass(player, grass) {
        const playerRect = player.getBoundingClientRect();
        const grassRect = grass.getBoundingClientRect();

        // Check if the player is within the grass area
        return (
            playerRect.top >= grassRect.top &&
            playerRect.bottom <= grassRect.bottom &&
            playerRect.left >= grassRect.left &&
            playerRect.right <= grassRect.right
        );
    }
});
