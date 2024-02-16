<?php
?>

<h1>Page de connexion</h1>

<form method="POST" action="index.php?action=login">
    <label for="email">Adresse mail : </label>
    <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

    <label for="password">Mot de passe : </label>
    <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

    <input type="submit" value="Se connecter">
</form>