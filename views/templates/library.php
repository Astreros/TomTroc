<?php
    $books = $searchResults ?? $allBooksAvailable ?? [];

?>

<section class="library">

    <div class="library-header">
        <h2>Nos livres à l'échange</h2>

        <form method="POST" action="index.php?action=search">
            <label for="search"></label>
            <span><i class="fas fa-search"></i><input type="search" id="search" name="search" minlength="3" maxlength="144" placeholder="Rechercher un livre"></span>
        </form>
    </div>

    <div class="cards-container-library">
        <?php

        if ($books === []) { ?>
                <p>Aucun livre trouvé</p>
            <?php
        } ?>

        <?php
        foreach ($books as $book) { ?>

            <div class="book-card">
            <a href="index.php?action=bookDetails&id=<?= $book->getId() ?>">
                <img src="<?= $book->getImage() ?>" alt="<?= $book->getTitle() ?>">
                <div class="text-card">
                    <p class="title-book-card"><?= substr($book->getTitle(), 0, 20) ?><?= strlen($book->getTitle()) > 20 ? '...' : ''?></p>
                    <p class="author-book-card"><?= $book->getAuthor() ?></p>
                    <p class="seller-book-card">Vendu par : <?= $book->getSeller() ?></p>
                </div>
            </a>
            </div><?php
        } ?>
    </div>
</section>

