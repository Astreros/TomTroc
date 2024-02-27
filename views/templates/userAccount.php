<?php
?>




<section class="user-account">
    <h2>Mon compte</h2>

    <div class="user-account-informations">
        <div class="user-informations">
            <div>
                <img src="" alt="">
                <a href="">modifier</a>
            </div>

            <div>
                <div>nathalire</div>
                <div>Membre depuis 1 an</div>
            </div>

            <div>
                <div>Bibliothèque</div>
                <div>4 livres</div>
            </div>
        </div>

        <div class="user-update-form">

            <div>Vos informations personnelles</div>

            <form method="POST" action="index.php?action=userUpdate">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" minlength="3" maxlength="320" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" minlength="3" maxlength="32" required>

                <input type="submit" value="Enregistrer">
            </form>

        </div>
    </div>

    <div class="user-books-details">

    </div>
</section>


