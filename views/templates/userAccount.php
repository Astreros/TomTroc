<?php
    $user = $_SESSION['user'];
    $userBooks  = $_SESSION['userBooks'];
?>

<section class="user-account">
    <h2>Mon compte</h2>

    <div class="error-box">
        <?php
        if (isset($emptyError)) {
            echo $emptyError;
        } elseif (isset($alreadyExistsError)) {
            echo $alreadyExistsError;
        } elseif (isset($errors)) {
            foreach ($errors as $error => $value) {
                echo $value.'<br/>';
            }
        }
        ?>
    </div>

    <div class="user-account-details">
        <div class="user-informations">
            <div class="user-informations-image">
                <img src="<?= $user->getImage() ?>" alt="<?= $user->getUsername() ?>">
                <form method="POST" action="index.php?action=updateUserImage"  enctype="multipart/form-data">
                    <input type="file" name="imageToUpload" id="imageToUpload" style="display: none;">
                    <a href="#" id="new-user-image-link">modifier</a>
                    <input type="submit" id="submit-new-image" style="display: none;" >
                    <div class="error-box">
                        <?php
                            if (isset($formatError)) {
                                echo $formatError;
                            }
                        ?>
                    </div>
                </form>
            </div>
            <div class="user-informations-details">
                <p class="user-informations-username"><?= $user->getUsername() ?></p>
                <p class="user-informations-seniority">Membre depuis <?= $user->getTimeSinceRegistration() ?></p>
                <p class="user-informations-library">BIBLIOTHÈQUE</p>
                <p class="user-informations-nb-book"><?= count($userBooks) > 1 ? count($userBooks) . ' livres' : (count($userBooks) === 1 ? '1 livre' : 'aucun livre') ?></p>
            </div>
            
        </div>

        <div class="user-update-form">
            <form method="POST" action="index.php?action=updateUser">
                <p>Vos informations personnelles</p>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" minlength="3" maxlength="320" required value="<?= $user->getEmail() ?>">

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" minlength="12" maxlength="72" required>

                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" minlength="3" maxlength="32" required value="<?= $user->getUsername() ?>">



                <input type="submit" <?= Utils::askConfirmation("Êtes-vous sûr de valider ces informations ? Vous allez être déconnectés.") ?> value="Enregistrer" >
            </form>
        </div>

        <div class="user-library tab-active">
            <table>
                <thead>
                    <tr>
                        <th>PHOTO</th>
                        <th>TITRE</th>
                        <th>AUTEUR</th>
                        <th>DESCRIPTION</th>
                        <th>DISPONIBILITÉ</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($userBooks as $key => $book) { ?>
                            <tr class="<?= $key%2 === 1 ? 'light' : ''?>">
                                <th class="user-library-details-image"><img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>"></th>
                                <th class="user-library-details-title"><?= $book->getTitle() ?></th>
                                <th class="user-library-details-author"><?= $book->getAuthor() ?></th>
                                <th class="user-library-details-description"><?= substr($book->getDescription(), 0, 80) ?><?= strlen($book->getDescription()) > 80 ? '...' : ''?></th>
                            <?php
                                if (!$book->getAvailable()) { ?>
                                    <th class="user-library-details-available"><div class="not-available">non disponible</div></th>
                                <?php } else { ?>
                                    <th class="user-library-details-available"><div class="available">disponible</div></th>
                                <?php }
                            ?>
                                <th class="user-library-details-actions"><a class="action-edit" href="index.php?action=bookFormUpdate&id=<?= $book->getId() ?>">Éditer</a> <a class="action-delete" href="index.php?action=deleteBook&id=<?= $book->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?>>Supprimer</a></th>
                            </tr><?php
                        }
                    ?>

                </tbody>
            </table>
        </div>

        <div class="user-library card-active">
            <?php
            foreach ($userBooks as $key => $book) { ?>
                <div class="user-library-details-card">
                    <div class="user-library-details-card-top">
                        <img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
                        <div class="user-library-details-card-top-text">
                            <div class="user-library-details-title"><?= $book->getTitle() ?></div>
                            <div class="user-library-details-author"><?= $book->getAuthor() ?></div>
                            <?php
                                if (!$book->getAvailable()) { ?>
                                    <div class="not-available">non disponible</div>
                                <?php } else { ?>
                                    <div class="available">disponible</div>
                                <?php }
                            ?>
                        </div>
                    </div>

                    <div class="user-library-details-description"><?= substr($book->getDescription(), 0, 80) ?><?= strlen($book->getDescription()) > 80 ? '...' : ''?></div>
                    <div class="user-library-details-actions">
                        <a class="action-edit" href="index.php?action=bookFormUpdate&id=<?= $book->getId() ?>">Éditer</a> <a class="action-delete" href="index.php?action=deleteBook&id=<?= $book->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?") ?>>Supprimer</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
