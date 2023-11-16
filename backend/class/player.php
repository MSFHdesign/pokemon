<?php
require_once 'pokeball.php';

class Player {
    public $activePokemon;
    private $pokemonInComputer = [];
    private $backpack = [
        'pokeballs' => [],
        'pokeCoins' => 50,
        'potions' => null,
    ];
    private $name = '';
    private $encounter = [];
    private $player_location;
    public function __construct() {
        $this->initPokeballs();
        $this->resumeCookies();
        $this->activePokemon = [];

}

        public static function createNewPlayer($playerName, $selectedPokemonId) {
        $newPlayer = new Player();
        $selectedPokemon = Pokemon::getPokemonById($selectedPokemonId);

        if (!$selectedPokemon) {
            return null;
        }

        $newPlayer->addActivePokemon($selectedPokemon); // Brug addActivePokemon-metoden

        $newPlayer->name = $playerName;

        $_SESSION['player'] = $newPlayer;
        $newPlayer->updatePlayerInfo($playerName, $selectedPokemonId);
        return $newPlayer;
    }
public function updatePlayerInfo($playerName, $selectedPokemonId) {
    $this->setName($playerName);

    // Opret de valgte Pokémon baseret på brugerens valg
    $selectedPokemon = new Pokemon($selectedPokemonId);


    // Fjern alle eksisterende aktive Pokémon og tilføj de nye valgte Pokémon
    $this->activePokemon = [$selectedPokemon];

    // Tilføj denne logningslinje
    error_log("Active Pokemon: " . print_r($this->activePokemon, true));

    // Gem opdaterede oplysninger i cookies
    $this->saveToCookies();
}



    public function startSession() {
        $_SESSION['player'] = [
            'activePokemon' => $this->activePokemon,
            'pokemonInComputer' => $this->pokemonInComputer,
            'backpack' => $this->backpack,
            'name' => $this->name,
            'encounter' => $this->encounter,
            'player_location' => 'pallet_town',
        ];
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    private function initPokeballs() {
        $this->backpack['pokeballs'] = [
            'regular' => new Pokeball(10, 1, 5),
        ];
    }

    private function saveToCookies() {
        // Set cookies for player data
        $cookieParams = session_get_cookie_params();
        setcookie('player', json_encode([
            'activePokemon' => $this->activePokemon,
            'pokemonInComputer' => $this->pokemonInComputer,
            'backpack' => $this->backpack,
            'name' => $this->name,
            'encounter' => $this->encounter,
            'player_location' => 'pallet_town',
        ]), time() + 60 * 60 * 24 * 30, $cookieParams['path'], null, false, true);
    }        

    private function resumeCookies() {
        if (isset($_COOKIE['player'])) {
            $playerData = json_decode($_COOKIE['player'], true);
            $this->activePokemon = $playerData['activePokemon'];
            $this->pokemonInComputer = $playerData['pokemonInComputer'];
            $this->backpack = $playerData['backpack'];
            $this->name = $playerData['name'];
            $this->encounter = $playerData['encounter'];
            $this->player_location = $playerData['player_location'];
        }
    }

    public function resetGame() {
        $this->setName('');
        $this->activePokemon = [];
        $this->pokemonInComputer = [];
        $this->initPokeballs(); // Initialiser pokeballs igen ved nulstilling af spillet
        $this->saveToCookies();

    }

   
    

    public function getPokemonInComputer() {
        return $this->pokemonInComputer;
    }



    public function addActivePokemon($pokemon) {
        $this->activePokemon[] = $pokemon;
        // Tilføj midlertidig fejlfinding her, hvis nødvendigt
        error_log("Added Pokemon to activePokemon: " . print_r($pokemon, true));
    }

    public function getActivePokemon() {
        return $this->activePokemon;
    }

    public function getActivePokemonWithMoves() {
        $activePokemon = $this->getActivePokemon()[0];    
        $formattedAttacks = $activePokemon->getFormattedAttacks();
        $activePokemon->setAttacks($formattedAttacks);
    
        return $activePokemon;
    }


    public function addPokemonToComputer($pokemon) {
        $this->pokemonInComputer[] = $pokemon;
    }

    public function getPokeCoins() {
        return $this->backpack['pokeCoins'];
    }
    public function addNewActivePokemon($newPokemon) {
        // Tjek om antallet af aktive Pokemon er mindre end 6, før du tilføjer den nye Pokemon
        if (count($this->activePokemon) < 6) {
            // Tilføj den nye Pokemon til listen over aktive Pokemon
            $this->activePokemon[] = $newPokemon;
            // Gem opdaterede oplysninger i cookies
            $this->saveToCookies();
            // Returner true for succesfuld tilføjelse
            return true;
        } else {
            // Returner en fejlmeddelelse, hvis der allerede er 6 aktive Pokemon
            return "You can't have more than 6 active Pokémon.";
        }
    }
    
    public function addPokeCoins($amount) {
        $this->backpack['pokeCoins'] += $amount;
        $this->saveToCookies();
    }
    public function getLocation() {
        return $this->player_location;
    }

}



?>
