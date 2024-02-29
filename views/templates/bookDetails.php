<?php
    $idCurrentUser = 0;

    if (isset($_SESSION['user'])) {
        $idCurrentUser = $_SESSION['user']->getId();
    }
?>

<section class="book-details">

    <div class="book-details-illustration">
        <img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
    </div>

    <div class="book-details-text">
        <div class="header-book-details-text">
            <h2 class="book-details-title"><?= $book->getTitle() ?></h2>
            <p class="book-details-author"><?= $book->getAuthor() ?></p>
            <div class="book-details-separator">___</div>
        </div>

        <div class="book-details-description">
            <p class="book-details-subtitle">DESCRIPTION</p>
            <p class="book-details-description-text"><?= $book->getDescription() ?></p>
        </div>

        <div class="book-details-owner">
            <p class="book-details-subtitle">PROPRIÉTAIRE</p>
            <a class="book-details-owner-photo" href="index.php?action=publicUserAccount&id=<?= $bookUser->getId() ?>">
                <img src="<?= $bookUser->getImage() ?>" alt="<?= $bookUser->getUsername() ?>">
                <p><?= $bookUser->getUsername() ?></p>
            </a>
        </div>

        <?php
            if ($bookUser->getId() !== $idCurrentUser) { ?>
                <div class="book-details-contact">
                    <a href="index.php?action=library" class="green-button">Envoyer un message</a>
                </div>
                <?php
            }
        ?>
    </div>

</section>

