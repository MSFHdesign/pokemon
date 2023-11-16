<?php
require_once 'Attack.php';
require_once __DIR__ . '/../SQL/connection.php';
class Pokemon {
    private $apiUrl = 'https://pokeapi.co/api/v2/pokemon/';

    private $level;
    public $name;
    public $type;
    public $attacks = [];
    public $health;
    public $id;
    public $image;
    private $experience = 0;
    public $speed;
    public $defence;
    public $special; 
    public $attack;
    private $evolve_level;
    private $capture_rate;

    public function __construct($pokemonId, $level = 5) {
        $this->fetchPokemonData($pokemonId);
        $this->fetchPokemonAttacks($pokemonId);

        $this->level = $level;
        $this->adjustStatsForLevel();
    }
    public static function getPokemonById($id) {
        return $id;
    }

    // private function fetchPokemonData($pokemonId) {
    //     $url = $this->apiUrl . $pokemonId;
    //     $pokemonData = json_decode(file_get_contents($url), true);
    //     $this->name = $pokemonData['name'];
    //     $this->type = $pokemonData['types'][0]['type']['name'];
    //     $this->height = $pokemonData['height'];
    //     $this->weight = $pokemonData['weight'];
    //     $this->health = $pokemonData['stats'][0]['base_stat'];
    //     $this->maxHealth = $pokemonData['stats'][0]['base_stat'];
    //     $this->id = $pokemonData['id'];
    //     $this->image = $pokemonData['sprites']['front_default'];
    //     $this->speed = $pokemonData['stats'][5]['base_stat'];
    //     $this-> defence = $pokemonData['stats'][2]['base_stat'];
    //     $this->attack = $pokemonData['stats'][1]['base_stat'];
    // }

    private function fetchPokemonData($pokemonId) {
        $sql = "SELECT * FROM Pokemon WHERE id = $pokemonId";
        global $conn;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Udfyld dine egenskaber baseret på data fra databasen
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->type = $row['type'];
            $this->image = $row['image'];
            $this->health = $row['health'];
            $this->attack = $row['attack'];
            $this-> defence = $row['defense'];
            $this->special = $row['special'];
            $this->speed = $row['speed'];
            $this->evolve_level = $row['evolve_level'];
            $this->attacks = $row['attacks'];
            $this->capture_rate = $row['capture_rate'];

        }
    }

    private function fetchPokemonAttacks($pokemonId) {
    //     $url = $this->apiUrl . $pokemonId;
    //     $pokemonData = json_decode(file_get_contents($url), true);
    
    //     // Tjek om $pokemonData['moves'] er en array
    //     if (is_array($pokemonData['moves'])) {
    //         foreach ($pokemonData['moves'] as $move) {
    //             if (count($this->attacks) < 4) {
    //                 // Opret et nyt Attack objekt og tilføj det til $this->attacks
    //                 $this->attacks[] = new Attack($move['move']['name'], 5);
    //             } else {
    //                 break; 
    //             }
    //         }
    //     } 
    // }
    global $conn;
    $sqlAttacks = "SELECT * FROM Pokemon WHERE id = $pokemonId";

    // Udfør SQL-query
    $resultAttacks = $conn->query($sqlAttacks);

    // Håndter resultatet
    if ($resultAttacks->num_rows > 0) {
        $row = $resultAttacks->fetch_assoc();

        // Hent attack_ids fra databasen
        $attackIds = explode(',', $row['attack_ids']);

        // Nulstil $this->attacks array
        $this->attacks = [];

        // Loop igennem attack_ids og hent de tilsvarende attacks fra Attacks-tabellen
        foreach ($attackIds as $attackId) {
            $attackSql = "SELECT * FROM Attacks WHERE id = $attackId";
            $attackResult = $conn->query($attackSql);

            if ($attackResult->num_rows > 0) {
                $attackRow = $attackResult->fetch_assoc();
                // Opret et nyt Attack objekt og tilføj det til $this->attacks
                $this->attacks[] = new Attack(
                    $attackRow['attack_name'],
                    $attackRow['damage'],
                    $attackRow['type'],
                    $attackRow['accuracy'],
                    $attackRow['pp'],
                    $attackRow['effect_percent'],
                    $attackRow['level_required'],
                    // Du kan tilføje andre nødvendige attributter her
                );
            }
        }
    }
}
public function getFormattedAttacks() {
    $formattedAttacks = [];

    foreach ($this->attacks as $attack) {
        // Tjek om $attack er et array
        if (is_array($attack)) {
            // Konverter arrayet til et Attack-objekt
            $attack = new Attack($attack['name'], $attack['damage']);
        }

        // Tilføj Attack-objektet til det formaterede array
        $formattedAttacks[] = [
            'name' => $attack->getName(),
            'damage' => $attack->getDamage(),
        ];
    }

    return $formattedAttacks;
}


public function setAttacks($attacks) {
    $this->attacks = $attacks;
}

public function __get($attribute) {
    if (property_exists($this, $attribute)) {
        return $this->$attribute;
    }
    return null;
}
    
    public function getAttacks() {
        return $this->attacks;
    }
    private function adjustStatsForLevel() {
        $this->health += $this->level;   

    }
    public function getLevel() {
        return $this->level;
    }

    public function getHealth() {
        return $this->health;
    }
    
    

    
    public function gainExperience($experience) {
        $this->experience += $experience;
        // Implementer yderligere logik baseret på dine krav

        // Check om Pokémon skal niveauop for hver 100 erfaring
        while ($this->experience >= 100) {
            $this->experience -= 100; // Træk 100 fra den akkumulerede erfaring
            $this->levelUp(); // Udløs niveauop-metoden
        }
    }

    public function levelUp() {
        $this->level++;
        $this->adjustStatsForLevel();
    }
    public function setLevel($level) {
        $this->level = $level;
    }
    public static function encounterWildPokemon() {
        $availablePokemon = [];
        $cookieData = json_decode($_COOKIE['player'], true);
        $playerLocation = $cookieData['player_location'];
    
        // Define the Pokémon with their respective probabilities based on player location
        $pokemonProbabilities = [];
    
        switch ($playerLocation) {
            case 'pallet_town':
                $pokemonProbabilities = [
                    ['id' => 16, 'level' => [2, 5], 'probability' => 30],
                    ['id' => 19, 'level' => [2, 5], 'probability' => 20],
                    ['id' => 13, 'level' => [2, 5], 'probability' => 10],
                    ['id' => 10, 'level' => [2, 5], 'probability' => 10],
                    ['id' => 29, 'level' => [3, 6], 'probability' => 15],
                    ['id' => 32, 'level' => [3, 6], 'probability' => 15],
                    ['id'=> 151, 'level' => [5,99], 'probability' => 1],
                    ['id'=> 150, 'level' => [5,99], 'probability' => 1],
                ];
                break;
    
            case 'route_1':
                $pokemonProbabilities = [
                    // Define Pokémon probabilities for route_1
                ];
                break;
    
            // Add more cases for other player locations as needed
    
            default:
                // Default case if player location is not recognized
                $pokemonProbabilities = [
                    ['id' => 16, 'level' => [2, 5], 'probability' => 30],
                    ['id' => 19, 'level' => [2, 5], 'probability' => 20],
                    ['id' => 13, 'level' => [2, 5], 'probability' => 10],
                    ['id' => 10, 'level' => [2, 5], 'probability' => 10],
                    ['id' => 29, 'level' => [3, 6], 'probability' => 15],
                    ['id' => 32, 'level' => [3, 6], 'probability' => 15],
                ];
                break;
        }
    
        // Rest of the code remains the same as in the previous example...
    
        // Calculate total probability
        $totalProbability = array_sum(array_column($pokemonProbabilities, 'probability'));
    
        // Randomly select a value within the total probability range
        $randomValue = rand(1, $totalProbability);
    
        // Iterate through Pokémon and find the one whose cumulative probability range includes the random value
        $cumulativeProbability = 0;
        foreach ($pokemonProbabilities as $pokemon) {
            $cumulativeProbability += $pokemon['probability'];
            if ($randomValue <= $cumulativeProbability) {
                $pokemonId = $pokemon['id'];
                $pokemonLevel = rand($pokemon['level'][0], $pokemon['level'][1]);
    
                // Create and configure the wild Pokémon
                $wildPokemon = new Pokemon($pokemonId, $pokemonLevel);
                $wildPokemon->setLevel($pokemonLevel);
    
                return $wildPokemon;
            }
        }
    
        // In case of an issue, return a default Pokémon
        return new Pokemon(6, 100);
    }
    



    public function getId() {
        return $this->id;
    }
    public function getName()  {
    return $this->name;    
    }

    
    public function attack($targetPokemon, $selectedAttackIndex) {
        // Hent det valgte angreb baseret på indekset
        $selectedAttack = $this->attacks[$selectedAttackIndex];

        // Beregn skade baseret på det valgte angreb og Pokémonens niveau
        $damage = $selectedAttack->calculateDamage($this->level);

        // Påfør skade på modstanderens Pokémon
        $targetPokemon->takeDamage($damage);
    }

    public function takeDamage($damage) {
        // Reducér Pokémonens sundhed baseret på modtaget skade
        $this->health -= $damage;

        // Implementer yderligere logik baseret på dine krav
    }

    public function getCatch_rate() {
        return $this->capture_rate;
    }

    public function getMaxHealth() {
        return $this->maxHealth;
    }
    public function getEvolveLevel() {
        return $this->evolve_level;
    }
    public function calculateCurrentHP($damage) {
        // Beregn den nuværende sundhed baseret på den modtagne skade
        $this->health -= $damage;
    
        // Sørg for, at sundheden ikke går under nul
        if ($this->health < 0) {
            $this->health = 0;
        }
    
        // Returnér den nuværende sundhed
        return $this->health;
    }

}    
?>
