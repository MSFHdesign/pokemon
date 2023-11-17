-- Active: 1693467841213@@mysql29.unoeuro.com@3306@siindevelopment_dk_db
-- Tabel for Player
CREATE TABLE Player (
    player_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    hashed_password VARCHAR(255) NOT NULL
);

-- Tabel for UserInfo
CREATE TABLE UserInfo (
    user_info_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    other_info TEXT,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);

-- Tabel for Party
CREATE TABLE Party (
    party_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    unique_id VARCHAR(255), -- Unikt id for Pokemon i spillerens party
    level INT,
    type VARCHAR(255),
    name VARCHAR(255),
    image VARCHAR(255),
    height DOUBLE,
    weight DOUBLE,
    health INT,
    speed INT,
    defence INT,
    attack INT,
    special INT,
    catch_rate DOUBLE,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);

-- Tabel for Computer
CREATE TABLE Computer (
    computer_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    unique_id VARCHAR(255), -- Unikt id for Pokemon i computeren
    level INT,
    type VARCHAR(255),
    name VARCHAR(255),
    image VARCHAR(255),
    height DOUBLE,
    weight DOUBLE,
    health INT,
    speed INT,
    defence INT,
    attack INT,
    special INT,
    catch_rate DOUBLE,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);

-- Tabel for UserSettings
CREATE TABLE UserSettings (
    settings_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    user_settings_info TEXT,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);

-- Tabel for GameHistory
CREATE TABLE GameHistory (
    history_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    game_info TEXT,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);

-- Tabel for Achievements
CREATE TABLE Achievements (
    achievement_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    achievement_info TEXT,
    FOREIGN KEY (player_id) REFERENCES Player(player_id)
);
