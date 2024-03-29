<?php
?>

<section class="registration-connexion-page">
    <div class="registration-connexion-form">
        <h2>Inscription</h2>

        <form method="POST" action="index.php?action=registration">

                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" minlength="3" maxlength="32" required>

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

                <input type="submit" value="S'inscrire">
        </form>

        <div class="error-box">
            <?php
            if (isset($errors)) {
                if (is_array($errors)) {
                    foreach ($errors as $error => $value) {
                        echo $value . '<br/>';
                    }
                } else {
                    echo $errors;
                }
            }
            ?>
        </div>

        <p class="login-or-registration-link">Déjà inscrit ? <a href="index.php?action=loginForm">Connectez-vous</a></p>
    </div>

    <div class="registration-connexion-form-illustration">
        <img src="./images/illustration/dd6bbafe9a461f128299f90d445728dd.jpg" alt="titre du livre">
    </div>
</section>
