<?php
?>
<section class="user-account public">
    <h2></h2>

    <div class="user-account-details public">
        <div class="user-informations">
            <div class="user-informations-image">
                <img src="<?= $publicUserAccount->getImage() ?? USER_IMAGE_DEFAULT_PATH?>" alt="<?= $publicUserAccount->getUsername() ?>">
                <a href="#">modifier</a>
            </div>
            <div class="user-informations-details">
                <p class="user-informations-username"><?= $publicUserAccount->getUsername() ?></p>
                <p class="user-informations-seniority">Membre depuis <?= $publicUserAccount->getTimeSinceRegistration() ?></p>
                <p class="user-informations-library">BIBLIOTHÈQUE</p>
                <p class="user-informations-nb-book"><?= count($publicUserBooks)?> <?= count($publicUserBooks) > 1 ? 'livres' : 'livre' ?></p>
            </div>

        </div>

        <div class="user-library tab-active">
            <table>
                <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR</th>
                    <th>DESCRIPTION</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($publicUserBooks as $key => $book) { ?>
                        <tr class="<?= $key%2 === 1 ? 'light' : ''?>">
                            <th class="user-library-details-image"><img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>"></th>
                            <th class="user-library-details-title"><?= $book->getTitle() ?></th>
                            <th class="user-library-details-author"><?= $book->getAuthor() ?></th>
                            <th class="user-library-details-description"><?= substr($book->getDescription(), 0, 80) ?><?= strlen($book->getDescription()) > 80 ? '...' : ''?></th>
                            </tr><?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="user-library card-active">
        <?php
        foreach ($publicUserBooks as $key => $book) { ?>
            <div class="user-library-details-card">
                <div class="user-library-details-card-top">
                    <img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
                    <div class="user-library-details-card-top-text">
                        <div class="user-library-details-title"><?= $book->getTitle() ?></div>
                        <div class="user-library-details-author"><?= $book->getAuthor() ?></div>
                    </div>
                </div>
                <div class="user-library-details-description"><?= substr($book->getDescription(), 0, 80) ?><?= strlen($book->getDescription()) > 80 ? '...' : ''?></div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
