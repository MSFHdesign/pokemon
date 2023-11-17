<!-- registration_form.php -->
<h2>Opret en ny spiller</h2>
<form method="post" action="">
    <label for="playerName">Brugernavn:</label>
    <input type="text" id="playerName" name="playerName" required>

    <label for="playerEmail">E-mail:</label>
    <input type="email" id="playerEmail" name="playerEmail" required>

    <label for="playerPassword">Adgangskode:</label>
    <input type="password" id="playerPassword" name="playerPassword" required>

    <button type="submit" name="registerNewPlayer">Opret Spiller</button>
</form>