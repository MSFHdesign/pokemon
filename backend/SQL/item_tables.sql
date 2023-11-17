-- Tabel for Item
CREATE TABLE Item (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price INT
);

-- Tabel for Inventory
CREATE TABLE Inventory (
    inventory_id INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT,
    item_id INT,
    quantity INT,
    FOREIGN KEY (player_id) REFERENCES Player(player_id),
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Tabel for Shop
CREATE TABLE Shop (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price INT,
    available BOOLEAN
);
