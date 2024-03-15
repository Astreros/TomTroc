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
                <img src="<?= $bookUser->getImage() ?? USER_IMAGE_DEFAULT_PATH?>" alt="<?= $bookUser->getUsername() ?>">
                <p><?= $bookUser->getUsername() ?></p>
            </a>
        </div>

        <?php
            if ($bookUser->getId() !== $idCurrentUser) { ?>
                <details class="book-details-contact">
                    <summary><div class="green-button">Envoyer un message</div></summary>

                    <div class="add-message-bloc">
                        <form  method="POST" action="index.php?action=addMessage" >
                            <label for="add-message"></label>
                            <textarea id="add-message" name="message"  minlength="1" maxlength="500" placeholder="Tapez votre message ici" required ><?= $messageToSend['content']  ?? '' ?></textarea>
                            <input type="hidden" name="recipientId" value="<?= $bookUser->getId() ?>">
                            <input type="submit" value="Envoyer">
                        </form>
                    </div>
                </details>
                <?php
            }
        ?>


    </div>

</section>

