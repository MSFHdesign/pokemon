<?php

require_once 'connection.php';

// Funktion til at indsætte ny bruger i databasen
function insertNewPlayer($playerName, $playerEmail, $playerPassword) {
    global $conn;

    // Hash adgangskoden
    $hashedPassword = password_hash($playerPassword, PASSWORD_DEFAULT);

    // Forbered udsagnet
    $stmt = $conn->prepare("INSERT INTO Player (username, email, hashed_password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $playerName, $playerEmail, $hashedPassword);

    // Udfør udsagnet
    if ($stmt->execute()) {
        // Opretningen lykkedes
        $stmt->close();
        return true;
    } else {
        // Fejl ved oprettelse af spiller
        $stmt->close();
        return false;
    }
}

?>
