<?php
// Funktion til at logge brugeren ud
function logUd() {
    // Fjern alle session-data
    session_unset();

    // Ødelæg sessionen
    session_destroy();
}

// Håndter logud-anmodning
if (isset($_POST['logOut'])) {
    logUd();

    // Redirect brugeren til log ind siden eller en anden relevant side
    header('Location: /index2.php');
    exit();
}
?>




    <form method="post" action="">
        <button type="submit" name="logOut">Log Ud</button>
    </form>
