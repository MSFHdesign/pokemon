<?php
$envFile = dirname(__DIR__, 2) . '/.env.local';

if (file_exists($envFile)) {
    $env = parse_ini_file($envFile, false, INI_SCANNER_RAW);

    $dbServer = $env['dbServer'];
    $dbUsername = $env['dbUsername'];
    $dbPassword = $env['dbPassword'];
    $dbName = $env['dbName'];

    // Opret en databaseforbindelse
    $conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);
    $conn->set_charset("utf8mb4");

    // Tjek for forbindelsesfejl
    if ($conn->connect_error) {
        die("Fejl ved forbindelse til databasen: " . $conn->connect_error);
    }
} else {
    echo "Fejl: Ingen .env.local fil fundet";
    exit;
}
?>
