<?php
?>

<h1>Page d'inscription</h1>

<form method="POST" action="index.php?action=registration">
    <label for="username">Votre nom d'utilisateur : </label>
    <input type="text" id="username" name="username" minlength="3" maxlength="32" required>

    <label for="email">Votre adresse mail : </label>
    <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

    <label for="password">Votre mot de passe : </label>
    <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

    <input type="submit" value="S'inscrire">
</form>

<?php


    if (isset($alreadyExistsError)) {

        echo $alreadyExistsError;

    } elseif (isset($emptyError)) {

        echo $emptyError;

    } elseif (isset($errors)) {

        foreach ($errors as $error => $value) {
            echo $value.'<br/>';
        }
    }
?>

