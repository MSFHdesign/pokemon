<?php 
include_once 'connection.php';

function loginPlayer($loginUsername, $loginPassword) {
    global $conn;

    // Hent brugeroplysninger baseret på brugernavn
    $sql = "SELECT * FROM Player WHERE username = '$loginUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificer adgangskoden
        if (password_verify($loginPassword, $row['hashed_password'])) {
            // Hvis adgangskoden er korrekt, gem brugeroplysninger i sessionen
            session_start();
            $_SESSION['user_id'] = $row['player_id'];
            $_SESSION['username'] = $row['username'];

            return true;
        }
    }

    return false;
}

?>