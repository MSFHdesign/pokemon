-- Active: 1693467841213@@mysql29.unoeuro.com@3306@siindevelopment_dk_db
-- Opret Pokemon-tabel

-- Drop Pokemon table if it exists
DROP TABLE IF EXISTS Pokemon;

-- Drop Attacks table if it exists
DROP TABLE IF EXISTS Attacks;


CREATE TABLE Pokemon (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    type VARCHAR(255),
    health INT,
    attack INT,
    defense INT,
    special INT,
    speed INT,
    level INT,
    evolve_level INT,
    capture_rate INT,
    image VARCHAR(255),
    attack_ids VARCHAR(255)
);

-- Opret Attacks-tabel
CREATE TABLE Attacks (
    id INT PRIMARY KEY,
    attack_name VARCHAR(255),
    damage INT,
    type_att VARCHAR(255),
    accuracy INT,
    pp INT,
    effect_percent INT,
    level_required INT
);


-- Indsæt Pokemon og deres attacks
INSERT INTO Pokemon (id, name, type, health, attack, defense, special, speed, level, evolve_level, capture_rate, image, attack_ids)
VALUES
    (1, 'Bulbasaur', 'Grass/Poison', 45, 49, 49, 65, 65, 5, 16, 45, 'bulbasaur', '1,2'),
    (2, 'Ivysaur', 'Grass/Poison', 60, 62, 63, 80, 80, 16, 32, 45, 'ivysaur', '1,2'),
    (3, 'Venusaur', 'Grass/Poison', 80, 82, 83, 100, 100, 32, 999, 45, 'venusaur', '1,2'),
    (4, 'Charmander', 'Fire', 39, 52, 43, 60, 50, 5, 16, 45, 'charmander', '3,4'),
    (5, 'Charmeleon', 'Fire', 58, 64, 58, 80, 80, 16, 36, 45, 'charmeleon', '3,4'),
    (6, 'Charizard', 'Fire/Flying', 78, 84, 78, 109, 100, 36, 999, 45, 'charizard', '3,4'),
    (7, 'Squirtle', 'Water', 44, 48, 65, 50, 43, 5, 16, 45, 'squirtle', '5,6'),
    (8, 'Wartortle', 'Water', 59, 63, 80, 65, 58, 16, 36, 45, 'wartortle', '5,6'),
    (9, 'Blastoise', 'Water', 79, 83, 100, 85, 78, 36, 999, 45, 'blastoise', '5,6'),
    (10, 'Caterpie', 'Bug', 45, 30, 35, 20, 45, 5, 7, 255, 'caterpie', '7,8'),
    (11, 'Metapod', 'Bug', 50, 20, 55, 25, 30, 7, 10, 120, 'metapod', '7,8'),
    (12, 'Butterfree', 'Bug/Flying', 60, 45, 50, 80, 70, 10, 999, 45, 'butterfree', '7,8'),
    (13, 'Weedle', 'Bug/Poison', 40, 35, 30, 20, 50, 5, 7, 255, 'weedle', '9,10'),
    (14, 'Kakuna', 'Bug/Poison', 45, 25, 50, 25, 35, 7, 10, 120, 'kakuna', '9,10'),
    (15, 'Beedrill', 'Bug/Poison', 65, 90, 40, 45, 75, 10, 999, 45, 'beedrill', '9,10'),
    (16, 'Pidgey', 'Normal/Flying', 40, 45, 40, 35, 56, 3, 18, 255, 'pidgey', '11,12'),
    (17, 'Pidgeotto', 'Normal/Flying', 63, 60, 55, 50, 71, 18, 36, 120, 'pidgeotto', '11,12'),
    (18, 'Pidgeot', 'Normal/Flying', 83, 80, 75, 70, 101, 36, 999, 45, 'pidgeot', '11,12'),
    (19, 'Rattata', 'Normal', 30, 56, 35, 25, 72, 3, 20, 255, 'rattata', '13,14'),
    (20, 'Raticate', 'Normal', 55, 81, 60, 50, 97, 20, 999, 127, 'raticate', '13,14'),
    (21, 'Spearow', 'Normal/Flying', 40, 60, 30, 31, 70, 7, 20, 255, 'spearow', '15,16'),
    (22, 'Fearow', 'Normal/Flying', 65, 90, 65, 61, 100, 20, 999, 90, 'fearow', '15,16'),
    (23, 'Ekans', 'Poison', 35, 60, 44, 40, 55, 7, 22, 255, 'ekans', '17,18'),
    (24, 'Arbok', 'Poison', 60, 85, 69, 65, 80, 22, 999, 90, 'arbok', '17,18'),
    (25, 'Pikachu', 'Electric', 35, 55, 30, 50, 90, 5, 999, 190, 'pikachu', '19,20'),
    (26, 'Raichu', 'Electric', 60, 90, 55, 90, 100, 20, 999, 75, 'raichu', '19,20'),
    (27, 'Sandshrew', 'Ground', 50, 75, 85, 30, 40, 7, 22, 255, 'sandshrew', '21,22'),
    (28, 'Sandslash', 'Ground', 75, 100, 110, 55, 65, 22, 999, 90, 'sandslash', '21,22'),
    (29, 'Nidoran\u2640', 'Poison', 55, 47, 52, 40, 41, 7, 16, 235, 'nidoran_f', '1,8'),
    (30, 'Nidorina', 'Poison', 70, 62, 67, 55, 56, 16, 32, 120, 'nidorina', '23,24'),
    (31, 'Nidoqueen', 'Poison/Ground', 90, 82, 87, 75, 76, 32, 999, 45, 'nidoqueen', '23,24'),
    (32, 'Nidoran\u2642', 'Poison', 46, 57, 40, 40, 50, 7, 16, 235, 'nidoran_m', '1,2'),
    (33, 'Nidorino', 'Poison', 61, 72, 57, 55, 65, 16, 32, 120, 'nidorino', '25,26'),
    (34, 'Nidoking', 'Poison/Ground', 81, 92, 77, 75, 85, 32, 999, 45, 'nidoking', '25,26'),
    (151, 'Mew', 'Psychic', 100, 80, 80, 100, 100, 50, NULL, 3.5, 'mew', '1,2,3'),
    (150, 'Mewtwo', 'Psychic', 120, 90, 90, 120, 110, 60, 50, 3.2, 'mewtwo', '4,5,6');


-- Inserting data for Mew
INSERT INTO Pokemon (id, name, type, health, attack, defense, special, speed, level, evolve_level, capture_rate, image, attack_ids)
VALUES (151, 'Mew', 'Psychic', 100, 80, 80, 100, 100, 50, NULL, 3.5, 'mew_image.jpg', '1,2,3');

-- Inserting data for Mewtwo
INSERT INTO Pokemon (id, name, type, health, attack, defense, special, speed, level, evolve_level, capture_rate, image, attack_ids)
VALUES (150, 'Mewtwo', 'Psychic', 120, 90, 90, 120, 110, 60, 50, 3.2, 'mewtwo_image.jpg', '4,5,6');


-- Indsæt Attacks-data
INSERT INTO Attacks (id, attack_name, damage, type_att, accuracy, pp, effect_percent, level_required)
VALUES
    (1, 'Tackle', 5, 'Normal', 95, 10, 0, 1),
    (2, 'Growl', 0, 'Normal', 100, 40, 0, 1),
    (3, 'Scratch', 5, 'Normal', 100, 10, 0, 1),
    (4, 'Ember', 8, 'Fire', 90, 5, 10, 7),
    (5, 'Leer', 0, 'Normal', 100, 30, 0, 1),
    (6, 'Quick Attack', 7, 'Normal', 100, 8, 0, 5),
    (7, 'Vine Whip', 7, 'Grass', 95, 10, 0, 3),
    (8, 'String Shot', 0, 'Bug', 95, 40, 0, 3),
    (9, 'Poison Sting', 15, 'Poison', 100, 35, 30, 8),
    (10, 'Peck', 35, 'Flying', 100, 35, 0, 7),
    (11, 'Water Gun', 7, 'Water', 100, 40, 0, 7),
    (12, 'Thunder Shock', 7, 'Electric', 100, 8, 0, 12),
    (13, 'Gust', 6, 'Flying', 95, 10, 0, 3),
    (14, 'Bubble', 15, 'Water', 100, 35, 30, 8),
    (15, 'Bite', 10, 'Normal', 95, 40, 0, 22),
    (16, 'Thunderbolt', 15, 'Electric', 90, 15, 0, 25),
    (17, 'Sand Attack', 0, 'Ground', 100, 15, 0, 7),
    (18, 'Earthquake', 50, 'Ground', 100, 10, 0, 30),
    (19, 'Ice Beam', 20, 'Ice', 90, 8, 0, 40),
    (20, 'Solar Beam', 30, 'Grass', 80, 5, 0, 50);
    

    
    ;