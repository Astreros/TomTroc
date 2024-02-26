<?php
?>

<section class="registration-page">
    <div class="registration-form">
        <h2>Inscription</h2>

        <form method="POST" action="index.php?action=registration">
            <label for="username">Votre nom d'utilisateur : </label>
            <input type="text" id="username" name="username" minlength="3" maxlength="32" required>

            <label for="email">Votre adresse mail : </label>
            <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

            <label for="password">Votre mot de passe : </label>
            <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <div class="registration-form-illustration">
        <img src="./images/illustration/dd6bbafe9a461f128299f90d445728dd.jpg" alt="titre du livre">
    </div>
</section>

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

