<?php
session_start();
require_once 'backend/SQL/addNewPlayer.php';
require_once 'backend/SQL/loginPlayer.php';
// ... (din eksisterende kode)

if (isset($_SESSION['user'])) {
    // Hvis brugeren allerede er logget ind
    header('Location: /maps/chooseStarter.php');
    exit();
}

// Registrering af ny spiller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registerNewPlayer'])) {
    // Hent værdier fra POST-data
    $playerName = $_POST['playerName'];
    $playerEmail = $_POST['playerEmail'];
    $playerPassword = $_POST['playerPassword'];

    // Kald funktionen til at indsætte ny bruger
    if (insertNewPlayer($playerName, $playerEmail, $playerPassword)) {
        // Hvis registreringen er succesfuld
        $_SESSION['userStatus'] = "newUser";
        $_SESSION['user'] = $playerName;
        header('Location: /maps/chooseStarter.php');
        exit();
    } else {
        // Hvis der opstår en fejl under registreringen
        echo "Fejl ved oprettelse af spiller.";
    }
}

// Log ind for eksisterende spiller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
// Håndter login-anmodning
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];

    // Kald funktionen til at validere og logge ind
    if (loginPlayer($loginUsername, $loginPassword)) {
        // Hvis login er succesfuld
        $_SESSION['userStatus'] = "newUser";
        $_SESSION['user'] = $loginUsername;
        header('Location: /maps/chooseStarter.php'); // Erstat med den faktiske side
        exit();
    } else {
        // Hvis login mislykkes
        echo "Forkert brugernavn eller adgangskode.";
    }
}
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">



<body>
    <?php if (isset($player) && !empty($player->getActivePokemon())) : ?>

    <?php else : ?>
        <!-- Registreringsformular -->
        <?php include './frontend/komponents/registration_form.php'; ?>

        <!-- Login-formular -->
        <?php include './frontend/komponents/login/login_form.php'; ?>
    <?php endif; ?>


</body>

</html>
