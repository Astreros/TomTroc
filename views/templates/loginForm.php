<?php
?>

<section class="registration-connexion-page">
    <div class="registration-connexion-form">
        <h2>Connexion</h2>

        <div class="success-box">
            <?php
                if (isset($success)) {
                    echo $success;
                }
            ?>
        </div>

        <form method="POST" action="index.php?action=login">

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

            <input type="submit" value="Se connecter">
        </form>

        <div class="error-box">
            <?php
                if (isset($emptyError)) {
                    echo $emptyError;
                } elseif (isset($loginError)) {
                    echo $loginError;
                } elseif (isset($errors)) {
                    foreach ($errors as $error => $value) {
                        echo $value.'<br/>';
                    }
                }
            ?>
        </div>

        <p class="login-or-registration-link">Pas de compte ? <a href="index.php?action=registrationForm">Inscrivez-vous</a></p>
    </div>

    <div class="registration-connexion-form-illustration">
        <img src="./images/illustration/dd6bbafe9a461f128299f90d445728dd.jpg" alt="titre du livre">
    </div>
</section>