<?php
    $bookToBeCreated = $tempData ?? null;
?>

<section class="book-form">
    <div class="book-form-head">
        <a href="index.php?action=userAccount"><- retour</a>
        <h2>Ajouter un livre</h2>
    </div>

    <form method="POST" action="index.php?action=createBook" enctype="multipart/form-data">
        <div class="left-book-form">
            <label for="imageToUpload">Photo</label>
            <img src="" alt="">
            <input type="hidden" name="oldImage" id="oldImage" value="">
            <input type="hidden" name="id" id="id" value="">
            <input type="file" name="imageToUpload" id="imageToUpload">
        </div>

        <div class="right-book-form">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="<?= $bookToBeCreated['title']  ?? '' ?>" minlength="3" maxlength="144" required>

            <label for="author">Auteur</label>
            <input type="text" id="author" name="author" value="<?= $bookToBeCreated['author']  ?? '' ?>" minlength="3" maxlength="32" required>

            <label for="description">Commentaire</label>
            <textarea name="description" id="description" minlength="50" maxlength="500" required><?= $bookToBeCreated['description']  ?? '' ?></textarea>

            <label for="available">Disponibilité</label>
            <select name="available" id="available" required>
                <option value="">--Veuillez choisir un statut--</option>
                <option value="1">Disponible</option>
                <option value="0">Non disponible</option>
            </select>

            <div class="error-box">
                <?php
                if (isset($errors)) {
                    foreach ($errors as $error => $value) {
                        echo $value . '<br/>';
                    }
                }
                ?>
            </div>

            <input type="submit" id="submit" value="Ajouter">
        </div>
    </form>
</section>